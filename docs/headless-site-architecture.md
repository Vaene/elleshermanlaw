# Elle Sherman Law Headless Site Architecture

## Final sitemap

- `/`
  - Hero
  - Credibility strip
  - Why Elle
  - Practice areas
  - Experience snapshot
  - Bio preview
  - Consultation CTA
- `/about`
  - Positioning statement
  - Attorney biography
  - Admissions and education
  - Approach and values
- `/experience`
  - Resume-backed timeline
  - Government-side experience
  - Advocacy and litigation experience
- `/practice`
  - Practice area index
- `/practice/[slug]`
  - Practice area detail
  - Summary
  - Related FAQs
  - CTA
- `/contact`
  - Contact details
  - Consultation form
- `/privacy-policy`
- `/disclaimer`

## Content outline

### Home

- Hero headline:
  - Immigration counsel shaped by experience inside DHS and in immigrant advocacy.
- Hero supporting copy:
  - Short explanation of Elle's dual perspective and practical, strategic guidance.
- Credibility strip:
  - New York bar admission
  - Southern District admission
  - Federal Immigration Court registration
  - Former DHS attorney
- Why Elle section:
  - Government-side insight
  - Immigrant-centered advocacy
  - Litigation fluency
- Practice area cards:
  - Removal defense strategy
  - Case evaluation
  - Motions and briefing
  - Government process insight
- Experience snapshot:
  - DHS
  - Litigation/trademark work
  - Cardozo clinic
- Bio preview:
  - Short attorney intro with portrait
- Final CTA:
  - Request a consultation

### About

- Positioning statement
- Full biography
- Admissions
- Education
- Office information
- Values:
  - Clear communication
  - Preparation
  - Calm, strategic advocacy

### Experience

- Intro paragraph
- Reverse-chronological experience timeline
- Optional education block

### Practice index

- Intro copy
- Practice area cards with summaries

### Practice detail

- Title
- Intro summary
- Body content
- FAQ list
- CTA block

### Contact

- Address
- Phone
- Email
- Contact form
- Optional consultation expectations note

## Drupal 11 content types and fields

### 1. `attorney_profile`

Use for Elle's profile. There will likely be one published node.

- `title`
  - Plain text
  - Example: `Elle Sherman`
- `field_short_title`
  - Plain text
  - Example: `Immigration Attorney`
- `field_headline`
  - Plain text
  - Homepage/about positioning line
- `field_portrait`
  - Image
- `field_bio_intro`
  - Plain text long
- `field_bio_body`
  - Formatted long text
- `field_admissions`
  - Plain text long or paragraph list
- `field_education`
  - Plain text long or paragraph list
- `field_credentials`
  - Plain text long
- `field_office_address`
  - Plain text
- `field_phone`
  - Telephone
- `field_email`
  - Email
- `field_sort_order`
  - Integer
  - Optional if more profiles are ever added

### 2. `practice_area`

- `title`
- `field_slug`
  - Use path alias instead if preferred
- `field_summary`
  - Plain text long
- `field_body`
  - Formatted long text
- `field_card_title`
  - Plain text
  - Optional shorter homepage card title
- `field_icon_token`
  - Plain text
  - Example: `brief`, `shield`, `gavel`
- `field_cta_label`
  - Plain text
- `field_cta_link`
  - Link
- `field_featured`
  - Boolean
- `field_sort_order`
  - Integer
- `field_related_faqs`
  - Entity reference to `faq_item`

### 3. `experience_item`

- `title`
  - Role title
- `field_organization`
  - Plain text
- `field_location`
  - Plain text
- `field_start_date`
  - Date
- `field_end_date`
  - Date
- `field_current_role`
  - Boolean
- `field_summary`
  - Plain text long
- `field_body`
  - Formatted long text
- `field_sort_order`
  - Integer

### 4. `faq_item`

- `title`
  - Question
- `field_answer`
  - Formatted long text
- `field_related_practice_areas`
  - Entity reference to `practice_area`
- `field_sort_order`
  - Integer

### 5. `basic_page`

Use for `About`, `Privacy Policy`, `Disclaimer`, and other general pages.

- `title`
- `field_intro`
  - Plain text long
- `field_body`
  - Formatted long text
- `field_hero_variant`
  - List text
  - Example values: `standard`, `minimal`, `legal`
- `field_show_contact_cta`
  - Boolean

### 6. `site_settings`

Recommended as a single configuration entity or a singleton content type.

- `field_site_tagline`
- `field_home_hero_heading`
- `field_home_hero_copy`
- `field_consultation_cta_label`
- `field_consultation_cta_link`
- `field_footer_blurb`
- `field_office_address`
- `field_phone`
- `field_email`
- `field_social_links`
  - Link, multi-value
- `field_default_seo_image`
  - Image

## Taxonomy

### `practice_category`

- Family-based immigration
- Removal defense
- Court appearances
- Strategy and evaluation

Optional for future filtering, not required for phase one.

## JSON:API exposure

Expose these resources first:

- `node--attorney_profile`
- `node--practice_area`
- `node--experience_item`
- `node--faq_item`
- `node--basic_page`
- media/image resources used by portrait or SEO images

Recommended JSON:API queries:

- Homepage:
  - featured practice areas
  - attorney profile
  - recent or ordered experience items
  - site settings
- Practice index:
  - all published practice areas sorted by `field_sort_order`
- Practice detail:
  - practice area by path alias or slug
  - related FAQ items
- About:
  - attorney profile plus `basic_page` content if desired

## Next.js frontend architecture

### App routes

- `src/app/layout.tsx`
- `src/app/page.tsx`
- `src/app/about/page.tsx`
- `src/app/experience/page.tsx`
- `src/app/practice/page.tsx`
- `src/app/practice/[slug]/page.tsx`
- `src/app/contact/page.tsx`
- `src/app/privacy-policy/page.tsx`
- `src/app/disclaimer/page.tsx`
- `src/app/api/contact/route.ts`

### Suggested folder structure

```text
frontend/src/
  app/
  components/
    layout/
    sections/
    cards/
    forms/
    ui/
  lib/
    drupal/
    seo/
    utils/
  types/
  content/
```

### Components by responsibility

#### Layout

- `components/layout/site-header.tsx`
- `components/layout/site-footer.tsx`
- `components/layout/page-shell.tsx`
- `components/layout/section-header.tsx`

#### Homepage sections

- `components/sections/home-hero.tsx`
- `components/sections/credibility-strip.tsx`
- `components/sections/why-elle.tsx`
- `components/sections/practice-grid.tsx`
- `components/sections/experience-preview.tsx`
- `components/sections/bio-preview.tsx`
- `components/sections/contact-cta.tsx`

#### Practice/detail

- `components/sections/practice-hero.tsx`
- `components/sections/faq-list.tsx`
- `components/cards/practice-card.tsx`
- `components/cards/experience-card.tsx`

#### Contact

- `components/forms/contact-form.tsx`
- `components/sections/contact-details.tsx`

#### UI primitives

- `components/ui/button.tsx`
- `components/ui/eyebrow.tsx`
- `components/ui/rich-text.tsx`
- `components/ui/container.tsx`
- `components/ui/stat-item.tsx`

## Data layer

### `lib/drupal`

- `client.ts`
  - fetch wrapper with base URL and revalidation
- `queries.ts`
  - JSON:API endpoint builders
- `mappers.ts`
  - normalize Drupal JSON:API responses into frontend-friendly types
- `get-site-settings.ts`
- `get-attorney-profile.ts`
- `get-practice-areas.ts`
- `get-practice-area-by-slug.ts`
- `get-experience-items.ts`
- `get-page-by-slug.ts`

### Suggested TypeScript models

- `SiteSettings`
- `AttorneyProfile`
- `PracticeArea`
- `ExperienceItem`
- `FaqItem`
- `BasicPage`

## Rendering strategy

- Home, About, Experience, Practice index:
  - statically rendered with revalidation
- Practice detail pages:
  - static params if practice area count stays small
- Contact:
  - static page with dynamic API form submission

## SEO and metadata

- Generate metadata per route from Drupal fields where possible
- Store:
  - SEO title
  - meta description
  - open graph image
  - canonical path

For phase one, add SEO fields to:

- `basic_page`
- `practice_area`
- `attorney_profile` or `site_settings`

## Phase-one build order

1. Create Drupal content types and fields.
2. Enter content for attorney profile, practice areas, and experience.
3. Expose JSON:API and validate the returned payloads.
4. Replace static content in the Next app with Drupal fetch helpers.
5. Add final legal pages and form handling.
