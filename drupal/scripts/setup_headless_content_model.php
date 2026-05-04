<?php

declare(strict_types=1);

use Drupal\Core\Entity\EntityStorageException;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;
use Drupal\path_alias\Entity\PathAlias;
use Drupal\taxonomy\Entity\Vocabulary;

function ensure_node_type(string $type, string $name, string $description = ''): void {
  $existing = NodeType::load($type);
  if ($existing) {
    return;
  }

  $content_type = NodeType::create([
    'type' => $type,
    'name' => $name,
    'description' => $description,
    'new_revision' => FALSE,
    'preview_mode' => 0,
    'display_submitted' => FALSE,
  ]);
  $content_type->save();
}

function ensure_vocabulary(string $vid, string $name): void {
  if (Vocabulary::load($vid)) {
    return;
  }

  Vocabulary::create([
    'vid' => $vid,
    'name' => $name,
  ])->save();
}

function ensure_field_storage(
  string $entity_type,
  string $field_name,
  string $field_type,
  array $settings = [],
  int $cardinality = 1,
): void {
  if (FieldStorageConfig::loadByName($entity_type, $field_name)) {
    return;
  }

  FieldStorageConfig::create([
    'entity_type' => $entity_type,
    'field_name' => $field_name,
    'type' => $field_type,
    'settings' => $settings,
    'cardinality' => $cardinality,
    'translatable' => TRUE,
  ])->save();
}

function ensure_field_instance(
  string $entity_type,
  string $bundle,
  string $field_name,
  string $label,
  array $settings = [],
  bool $required = FALSE,
  string $description = '',
): void {
  $existing = FieldConfig::loadByName($entity_type, $bundle, $field_name);
  if ($existing) {
    $existing->set('label', $label);
    $existing->set('settings', $settings);
    $existing->set('required', $required);
    $existing->set('description', $description);
    $existing->save();
    return;
  }

  FieldConfig::create([
    'entity_type' => $entity_type,
    'bundle' => $bundle,
    'field_name' => $field_name,
    'label' => $label,
    'settings' => $settings,
    'required' => $required,
    'description' => $description,
  ])->save();
}

function ensure_alias(string $path, string $alias): void {
  $storage = \Drupal::entityTypeManager()->getStorage('path_alias');
  $existing = $storage->loadByProperties(['alias' => $alias]);
  foreach ($existing as $entity) {
    if ($entity->getPath() === $path) {
      return;
    }
    $entity->delete();
  }

  PathAlias::create([
    'path' => $path,
    'alias' => $alias,
    'langcode' => 'en',
  ])->save();
}

function ensure_node(string $bundle, string $title, array $values = []): Node {
  $storage = \Drupal::entityTypeManager()->getStorage('node');
  $existing = $storage->loadByProperties([
    'type' => $bundle,
    'title' => $title,
  ]);

  /** @var \Drupal\node\Entity\Node|null $node */
  $node = $existing ? reset($existing) : NULL;
  if (!$node) {
    $node = Node::create([
      'type' => $bundle,
      'title' => $title,
      'status' => 1,
    ]);
  }

  foreach ($values as $field => $value) {
    $node->set($field, $value);
  }
  $node->setPublished(TRUE);
  $node->save();

  return $node;
}

ensure_node_type('attorney_profile', 'Attorney Profile', 'Attorney biography and office details.');
ensure_node_type('practice_area', 'Practice Area', 'Structured practice area content for the headless frontend.');
ensure_node_type('experience_item', 'Experience Item', 'Timeline entries for the attorney experience page.');
ensure_node_type('faq_item', 'FAQ Item', 'Frequently asked questions tied to practice areas.');
ensure_node_type('basic_page', 'Basic Page', 'General content pages for the site.');
ensure_node_type('site_settings', 'Site Settings', 'Singleton-style site settings content.');

ensure_vocabulary('practice_category', 'Practice Category');

$string_fields = [
  'field_short_title' => 'Short Title',
  'field_headline' => 'Headline',
  'field_slug' => 'Slug',
  'field_card_title' => 'Card Title',
  'field_icon_token' => 'Icon Token',
  'field_cta_label' => 'CTA Label',
  'field_organization' => 'Organization',
  'field_location' => 'Location',
  'field_site_tagline' => 'Site Tagline',
  'field_home_hero_heading' => 'Home Hero Heading',
  'field_consultation_cta_label' => 'Consultation CTA Label',
  'field_contact_title' => 'Contact Title',
  'field_contact_success_message' => 'Contact Success Message',
  'field_hero_variant' => 'Hero Variant',
];

foreach ($string_fields as $field_name => $label) {
  ensure_field_storage('node', $field_name, 'string', ['max_length' => 255]);
}

ensure_field_storage('node', 'field_phone', 'string', ['max_length' => 255]);
ensure_field_storage('node', 'field_email', 'email');
ensure_field_storage('node', 'field_sort_order', 'integer');
ensure_field_storage('node', 'field_featured', 'boolean');
ensure_field_storage('node', 'field_current_role', 'boolean');
ensure_field_storage('node', 'field_show_contact_cta', 'boolean');
ensure_field_storage('node', 'field_summary', 'string_long');
ensure_field_storage('node', 'field_bio_intro', 'string_long');
ensure_field_storage('node', 'field_admissions', 'string_long');
ensure_field_storage('node', 'field_education', 'string_long');
ensure_field_storage('node', 'field_credentials', 'string_long');
ensure_field_storage('node', 'field_office_address', 'string_long');
ensure_field_storage('node', 'field_home_hero_copy', 'string_long');
ensure_field_storage('node', 'field_contact_intro', 'string_long');
ensure_field_storage('node', 'field_footer_blurb', 'string_long');
ensure_field_storage('node', 'field_intro', 'string_long');
ensure_field_storage('node', 'field_body', 'text_long');
ensure_field_storage('node', 'field_bio_body', 'text_long');
ensure_field_storage('node', 'field_answer', 'text_long');
ensure_field_storage('node', 'field_cta_link', 'link');
ensure_field_storage('node', 'field_social_links', 'link', [], -1);
ensure_field_storage('node', 'field_start_date', 'datetime', ['datetime_type' => 'date']);
ensure_field_storage('node', 'field_end_date', 'datetime', ['datetime_type' => 'date']);
ensure_field_storage('node', 'field_portrait', 'image', ['uri_scheme' => 'public', 'default_image' => ['uuid' => NULL]]);
ensure_field_storage('node', 'field_default_seo_image', 'image', ['uri_scheme' => 'public', 'default_image' => ['uuid' => NULL]]);
ensure_field_storage('node', 'field_related_faqs', 'entity_reference', ['target_type' => 'node'], -1);
ensure_field_storage('node', 'field_related_practice_areas', 'entity_reference', ['target_type' => 'node'], -1);
ensure_field_storage('node', 'field_practice_categories', 'entity_reference', ['target_type' => 'taxonomy_term'], -1);

$hero_variants = [
  'standard' => 'Standard',
  'minimal' => 'Minimal',
  'legal' => 'Legal',
];
ensure_field_storage('node', 'field_hero_variant', 'list_string', ['allowed_values' => $hero_variants]);

$bundles = [
  'attorney_profile' => [
    'field_short_title',
    'field_headline',
    'field_portrait',
    'field_bio_intro',
    'field_bio_body',
    'field_admissions',
    'field_education',
    'field_credentials',
    'field_office_address',
    'field_phone',
    'field_email',
    'field_sort_order',
  ],
  'practice_area' => [
    'field_slug',
    'field_summary',
    'field_body',
    'field_card_title',
    'field_icon_token',
    'field_cta_label',
    'field_cta_link',
    'field_featured',
    'field_sort_order',
    'field_related_faqs',
    'field_practice_categories',
  ],
  'experience_item' => [
    'field_organization',
    'field_location',
    'field_start_date',
    'field_end_date',
    'field_current_role',
    'field_summary',
    'field_body',
    'field_sort_order',
  ],
  'faq_item' => [
    'field_answer',
    'field_related_practice_areas',
    'field_sort_order',
  ],
  'basic_page' => [
    'field_slug',
    'field_intro',
    'field_body',
    'field_hero_variant',
    'field_show_contact_cta',
  ],
  'site_settings' => [
    'field_site_tagline',
    'field_home_hero_heading',
    'field_home_hero_copy',
    'field_consultation_cta_label',
    'field_contact_title',
    'field_contact_intro',
    'field_contact_success_message',
    'field_cta_link',
    'field_footer_blurb',
    'field_office_address',
    'field_phone',
    'field_email',
    'field_social_links',
    'field_default_seo_image',
  ],
];

$labels = [
  'field_short_title' => 'Short Title',
  'field_headline' => 'Headline',
  'field_portrait' => 'Portrait',
  'field_bio_intro' => 'Bio Intro',
  'field_bio_body' => 'Bio Body',
  'field_admissions' => 'Admissions',
  'field_education' => 'Education',
  'field_credentials' => 'Credentials',
  'field_office_address' => 'Office Address',
  'field_phone' => 'Phone',
  'field_email' => 'Email',
  'field_sort_order' => 'Sort Order',
  'field_slug' => 'Slug',
  'field_summary' => 'Summary',
  'field_body' => 'Body',
  'field_card_title' => 'Card Title',
  'field_icon_token' => 'Icon Token',
  'field_cta_label' => 'CTA Label',
  'field_cta_link' => 'CTA Link',
  'field_featured' => 'Featured',
  'field_related_faqs' => 'Related FAQs',
  'field_practice_categories' => 'Practice Categories',
  'field_organization' => 'Organization',
  'field_location' => 'Location',
  'field_start_date' => 'Start Date',
  'field_end_date' => 'End Date',
  'field_current_role' => 'Current Role',
  'field_answer' => 'Answer',
  'field_related_practice_areas' => 'Related Practice Areas',
  'field_intro' => 'Intro',
  'field_hero_variant' => 'Hero Variant',
  'field_show_contact_cta' => 'Show Contact CTA',
  'field_site_tagline' => 'Site Tagline',
  'field_home_hero_heading' => 'Home Hero Heading',
  'field_home_hero_copy' => 'Home Hero Copy',
  'field_consultation_cta_label' => 'Consultation CTA Label',
  'field_contact_title' => 'Contact Title',
  'field_contact_intro' => 'Contact Intro',
  'field_contact_success_message' => 'Contact Success Message',
  'field_footer_blurb' => 'Footer Blurb',
  'field_social_links' => 'Social Links',
  'field_default_seo_image' => 'Default SEO Image',
];

foreach ($bundles as $bundle => $fields) {
  foreach ($fields as $field_name) {
    $settings = [];

    if ($field_name === 'field_related_faqs' || $field_name === 'field_related_practice_areas') {
      $target_bundle = $field_name === 'field_related_faqs' ? 'faq_item' : 'practice_area';
      $settings = [
        'handler' => 'default:node',
        'handler_settings' => ['target_bundles' => [$target_bundle => $target_bundle]],
      ];
    }
    elseif ($field_name === 'field_practice_categories') {
      $settings = [
        'handler' => 'default:taxonomy_term',
        'handler_settings' => ['target_bundles' => ['practice_category' => 'practice_category']],
      ];
    }

    ensure_field_instance('node', $bundle, $field_name, $labels[$field_name], $settings);
  }
}

$site_settings = ensure_node('site_settings', 'Global Site Settings', [
  'field_site_tagline' => 'Immigration counsel with courtroom depth',
  'field_home_hero_heading' => 'Strategic immigration counsel informed by government-side experience and direct advocacy.',
  'field_home_hero_copy' => 'Immigration representation with a personal touch, grounded in courtroom experience and clear client communication.',
  'field_consultation_cta_label' => 'Free Consultation',
  'field_contact_title' => 'Contact Info',
  'field_contact_intro' => 'Contact us for your immigration needs and share a short overview of your situation.',
  'field_contact_success_message' => 'Your message has been sent.',
  'field_cta_link' => ['uri' => 'internal:/contact', 'title' => 'Free Consultation'],
  'field_footer_blurb' => 'Immigration and general legal services, we provide the personal touch.',
  'field_office_address' => "1737 York Ave #3B\nNew York, NY 10128",
  'field_phone' => '917.806.2531',
  'field_email' => 'elle.sherman@gmail.com',
]);

$profile = ensure_node('attorney_profile', 'Elle Sherman', [
  'field_short_title' => 'Immigration Attorney',
  'field_headline' => 'Calm, strategic immigration guidance informed by both DHS litigation and client advocacy.',
  'field_bio_intro' => 'Elle Sherman is a New York attorney whose experience spans immigration proceedings, litigation, and legal writing.',
  'field_bio_body' => [
    'value' => '<p>Elle Sherman currently serves as a General Attorney with the U.S. Department of Homeland Security, representing the government in removal proceedings before immigration judges. That experience informs a thoughtful, practical approach to legal advocacy for immigrants and families navigating high-stakes systems.</p><p>She earned her J.D. from Benjamin N. Cardozo School of Law and is admitted in New York State, the Southern District, and Federal Immigration Court.</p>',
    'format' => 'basic_html',
  ],
  'field_admissions' => "New York State Bar\nSouthern District of New York\nFederal Immigration Court",
  'field_education' => "Benjamin N. Cardozo School of Law, J.D. 2014\nHunter College, B.A., summa cum laude, Theatre Arts, 2009",
  'field_credentials' => "Former DHS attorney\nCourtroom immigration experience\nLitigation and legal writing background",
  'field_office_address' => "1737 York Ave #3B\nNew York, NY 10128",
  'field_phone' => '917.806.2531',
  'field_email' => 'elle.sherman@gmail.com',
]);

$practice_areas = [
  [
    'title' => 'Removal Defense Strategy',
    'slug' => 'removal-defense-strategy',
    'summary' => 'Clear, practical guidance for people navigating removal proceedings and high-stakes hearings.',
    'body' => '<p>Strategic support for removal proceedings, hearings, and case planning shaped by real courtroom knowledge.</p>',
    'featured' => TRUE,
    'sort' => 10,
  ],
  [
    'title' => 'Case Evaluation',
    'slug' => 'case-evaluation',
    'summary' => 'Early assessments focused on timing, procedural posture, and the evidence that matters most.',
    'body' => '<p>Focused case evaluation to understand posture, risks, options, and likely decision points.</p>',
    'featured' => TRUE,
    'sort' => 20,
  ],
  [
    'title' => 'Motions and Briefing',
    'slug' => 'motions-and-briefing',
    'summary' => 'Written advocacy, legal research, and persuasive framing for court-ready filings.',
    'body' => '<p>Support for legal research, motions, and briefing where strong written advocacy can change the path of a case.</p>',
    'featured' => TRUE,
    'sort' => 30,
  ],
  [
    'title' => 'Government Process Insight',
    'slug' => 'government-process-insight',
    'summary' => 'Advice informed by understanding how agencies, prosecutors, and immigration courts evaluate discretion.',
    'body' => '<p>Guidance shaped by understanding how the system evaluates cases from inside institutions as well as from the client side.</p>',
    'featured' => TRUE,
    'sort' => 40,
  ],
];

$practice_nodes = [];
foreach ($practice_areas as $item) {
  $practice_node = ensure_node('practice_area', $item['title'], [
    'field_slug' => $item['slug'],
    'field_summary' => $item['summary'],
    'field_body' => ['value' => $item['body'], 'format' => 'basic_html'],
    'field_card_title' => $item['title'],
    'field_icon_token' => 'brief',
    'field_cta_label' => 'Request a consultation',
    'field_cta_link' => ['uri' => 'internal:/contact', 'title' => 'Request a consultation'],
    'field_featured' => $item['featured'] ? 1 : 0,
    'field_sort_order' => $item['sort'],
  ]);
  $practice_nodes[$item['slug']] = $practice_node;
  ensure_alias('/node/' . $practice_node->id(), '/practice/' . $item['slug']);
}

$experience_items = [
  ['General Attorney', 'U.S. Department of Homeland Security', 'New York, NY', '2024-02-01', NULL, 1, 'Represents the U.S. government in removal proceedings before immigration judges, handling legal research, briefing, witness examinations, oral argument, negotiation, and litigation support.', 10],
  ['Associate', 'Adelman Matz P.C.', 'New York, NY', '2022-07-01', '2023-04-01', 0, 'Worked across trademark and litigation matters, drafting briefs, pleadings, cease-and-desist letters, office action responses, and client-facing legal strategy materials.', 20],
  ['Manager / Partner', 'Esquire Per Diem', 'New York, NY', '2016-01-01', '2020-03-01', 0, 'Led operations, recruiting, client service, scheduling, and fulfillment for a high-volume court appearance business.', 30],
  ['Per Diem Attorney', 'Esquire Per Diem', 'New York, NY', '2015-07-01', '2016-01-01', 0, 'Handled New York court appearances including settlement negotiations, motions, conferences, and depositions.', 40],
  ['Clinical Intern', 'Cardozo Youth Justice Clinic', 'New York, NY', '2014-01-01', '2014-05-01', 0, 'Supported client advocacy, impact work, interviewing, counseling, and oral advocacy in education and justice-related matters.', 50],
];

foreach ($experience_items as [$title, $org, $location, $start, $end, $current, $summary, $sort]) {
  ensure_node('experience_item', $title, [
    'field_organization' => $org,
    'field_location' => $location,
    'field_start_date' => $start,
    'field_end_date' => $end,
    'field_current_role' => $current,
    'field_summary' => $summary,
    'field_body' => ['value' => '<p>' . $summary . '</p>', 'format' => 'basic_html'],
    'field_sort_order' => $sort,
  ]);
}

$faq_specs = [
  [
    'title' => 'What makes this practice different?',
    'answer' => '<p>Elle Sherman brings perspective from both government-side immigration litigation and client-centered legal advocacy.</p>',
    'practice_slug' => 'government-process-insight',
  ],
  [
    'title' => 'Can I request an initial case evaluation?',
    'answer' => '<p>Yes. The site is designed to encourage direct, efficient consultation requests through the contact page.</p>',
    'practice_slug' => 'case-evaluation',
  ],
];

$faq_nodes = [];
foreach ($faq_specs as $index => $faq) {
  $practice_node = $practice_nodes[$faq['practice_slug']] ?? NULL;
  $faq_node = ensure_node('faq_item', $faq['title'], [
    'field_answer' => ['value' => $faq['answer'], 'format' => 'basic_html'],
    'field_related_practice_areas' => $practice_node ? [['target_id' => $practice_node->id()]] : [],
    'field_sort_order' => ($index + 1) * 10,
  ]);
  $faq_nodes[$faq['title']] = $faq_node;
}

if (isset($practice_nodes['case-evaluation'], $faq_nodes['Can I request an initial case evaluation?'])) {
  $practice_nodes['case-evaluation']->set('field_related_faqs', [
    ['target_id' => $faq_nodes['Can I request an initial case evaluation?']->id()],
  ]);
  $practice_nodes['case-evaluation']->save();
}

if (isset($practice_nodes['government-process-insight'], $faq_nodes['What makes this practice different?'])) {
  $practice_nodes['government-process-insight']->set('field_related_faqs', [
    ['target_id' => $faq_nodes['What makes this practice different?']->id()],
  ]);
  $practice_nodes['government-process-insight']->save();
}

$about_page = ensure_node('basic_page', 'About', [
  'field_slug' => 'about',
  'field_intro' => 'A law practice shaped by courtroom rigor, public-service experience, and direct client advocacy.',
  'field_body' => [
    'value' => '<p>Elle Sherman&apos;s practice brings together public-service experience, courtroom work, and a client-centered approach to immigration matters. The goal is straightforward guidance, careful preparation, and direct communication from first contact through case strategy.</p><p>The earlier Ellesq.com site emphasized a personal touch. This updated version keeps that spirit while presenting a clearer view of Elle&apos;s immigration-focused experience and current work.</p>',
    'format' => 'basic_html',
  ],
  'field_hero_variant' => 'standard',
  'field_show_contact_cta' => 1,
]);
ensure_alias('/node/' . $about_page->id(), '/about');

$privacy_page = ensure_node('basic_page', 'Privacy Policy', [
  'field_slug' => 'privacy-policy',
  'field_intro' => 'Privacy policy placeholder for the headless site.',
  'field_body' => ['value' => '<p>Add the practice privacy policy here.</p>', 'format' => 'basic_html'],
  'field_hero_variant' => 'legal',
  'field_show_contact_cta' => 0,
]);
ensure_alias('/node/' . $privacy_page->id(), '/privacy-policy');

$disclaimer_page = ensure_node('basic_page', 'Disclaimer', [
  'field_slug' => 'disclaimer',
  'field_intro' => 'Disclaimer placeholder for the headless site.',
  'field_body' => ['value' => '<p>Add the practice disclaimer here.</p>', 'format' => 'basic_html'],
  'field_hero_variant' => 'legal',
  'field_show_contact_cta' => 0,
]);
ensure_alias('/node/' . $disclaimer_page->id(), '/disclaimer');

print "Headless content model and seed content ensured.\n";
