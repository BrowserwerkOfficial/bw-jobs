# Changelog

All notable changes to this project will be documented in this file.

## [2.3.3] - 2023-06-27

### Added
- TypoScript constant for configuring date format in detail view.

### Changed
- Updated Bootstrap.

## [2.3.2] - 2023-06-27

### Changed
- Hide job application call-to-action when `direct_application_possible` is false.

### Fixed
- Missing homeofficePublic property in JobPosition model class.

## [2.3.0] - 2023-06-27

### Changed
- Set applicantLocationRequirements in JSON-LD structured data when homeoffice is enabled.
- Updated dependencies.

## [2.2.4] - 2022-09-29

### Changed
- Updated dependencies.

## [2.2.3] - 2022-08-08

### Added
- Sponsoring details in the footer of the backend modules and the repository.

## [2.2.2] - 2022-07-28

### Fixed
- Definition of `EducationalOccupationalCredential` in structured data.
- "missing storage uid" error with restricted users.

### Added
- Footer in backend modules.

## [2.2.1] - 2022-07-25

### Fixed
- Wrong controller name in TypoScript config for `tx_seo`.

### Added
- `experienceRequirements`, `responsibilities` and `jobBenefits` to the `description` in JSON-LD structured data.

## [2.2.0] - 2022-07-12

### Added
- `directApplicationPossible` option to job positions.
- `benefits` to job positions.
- Structured data for `experienceRequirements`, `responsibilities`, `jobBenefits`, `jobLocationType` and `directApply`.

## [2.1.5] - 2022-06-30

### Fixed
- Duplicate slashes in list view URLs.

## [2.1.4] - 2022-06-30

### Fixed
- Duplicate slashes in list view URLs.

## [2.1.3] - 2022-06-30

### Fixed
- List view not respecting the current language.
- Slugs with leading slash causing invalid URLs in list view.

## [2.1.2] - 2022-06-30

### Fixed
- Pagination `next` button.
- `title` attribute in list view not implemented.

### Added
- Headlines shown on the detail pages can now be hidden in the `Visibility` tab.

## [2.1.1] - 2022-06-28

### Fixed
- Composer install command in README.

## [2.1.0] - 2022-06-28

### Fixed
- Linking to detail view without a job position now redirects to the list view.
- Fixed label of `work_hours` field in backend view.
- Composer installation instruction in README.

### Added
- The list view now renders via JavaScript, which removes the page reload on changing the filter.
- The filter is now persisted between page loads.
- Specific data about a job position can now be hidden from the visitor in the new `Visibility` tab in the backend view of a job position.
- The job title is now added to the email body.
- A new `address` field is now available to contact persons.
- Added a SEO configuration snippet to README.

### Changed
- The list view template was removed from Fluid rendering.

