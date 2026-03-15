# Drupal Upgrade and DDEV Notes

## Current state

- The legacy Drupal 9.5 project has been upgraded locally to Drupal 11.3.5.
- The site is running in DDEV with MySQL 8.0.
- The database import succeeds locally from `elleshermanlaw_db_2026-03-15.sql.gz`.
- The site is using core-supported themes: `olivero` and `claro`.

## What changed

- Legacy contrib themes that only supported Drupal 8/9 were removed from Composer.
- The unused Adminimal admin theme package was removed before the Drupal 11 update.
- DDEV was switched from MariaDB 10.11 to MySQL 8.0 so the imported dump's collation would load correctly.

## DDEV startup

1. Start Docker Desktop or another Docker provider.
2. Run `ddev start` from the repository root.
3. Run `ddev import-db --file=/path/to/current-database.sql.gz` after you have a database dump.
4. Run `ddev exec bash -lc "cd /var/www/html/drupal && composer install"`.
5. Run `ddev exec bash -lc "cd /var/www/html/drupal && bash vendor/bin/drush updb -y && bash vendor/bin/drush cr"`.

## Next steps

- Export configuration if you want the current local theme/runtime state captured.
- Begin exposing the content model through JSON:API for the new frontend.
- Proceed with the Next.js headless build against the Drupal 11 backend.
