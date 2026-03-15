# Elle Sherman Law Headless Revamp Plan

## Recommended stack

- Backend: upgrade the current Drupal 9.5 install to Drupal 11 and use it as the content management backend.
- Frontend: Next.js App Router in `/frontend` for the public site.
- Content API: Drupal JSON:API for pages, attorney bio, services, FAQs, and testimonials if added later.
- Forms: Drupal Webform or a dedicated mail transport connected to the Next.js contact endpoint.

## Why Next.js here

- It is a strong fit for a lightweight marketing site with a few high-value pages.
- The App Router gives flexible static rendering now and CMS-backed content later.
- It keeps the migration path simple if the Drupal backend is refreshed in phases.

## Recommended Drupal content model

- `page`: title, slug, intro, rich body, SEO fields.
- `service`: title, summary, body, CTA label, CTA link, icon token, sort order.
- `experience_item`: role, organization, start date, end date, summary.
- `site_settings`: office address, email, phone, consultation CTA, footer text.
- `attorney_profile`: name, credentials, portrait, biography, admissions, education.

## Migration path

1. Upgrade the existing Drupal codebase to Drupal 10 and then Drupal 11.
2. Replace the current theme dependency with admin/editor focused tooling only.
3. Model core content types in Drupal and expose them through JSON:API.
4. Keep the new Next.js frontend statically driven at first, then switch sections over to API-backed content.
5. Connect the contact form to Drupal Webform submissions or SMTP-backed delivery.

## Design direction

- Keep the visual language light and editorial instead of dark and corporate.
- Emphasize Elle's dual perspective: DHS experience plus immigrant advocacy.
- Use short pages with strong typography, clear scannability, and one primary CTA per screen.

## Pages for phase one

- Home
- About
- Experience
- Contact

## Notes

- The current repo contains a legacy Drupal theme approach and no separate headless frontend.
- The new `frontend` app is a working design prototype and should become the public web layer.
