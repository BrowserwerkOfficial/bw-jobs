# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [2.1.2] - WIP

### Fixed
- Pagination "next" button.

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

