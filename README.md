# BW Jobs

The BW Jobs extension allows you to manage and present open job positions on your TYPO3 website.

## Features

- Filterable list view with pagination
- Separate plugins for list and detail view
- Customizable, pre styled templates
- Application form with upload for documents
- Structured JSON-LD data
- Ships with multiple languages (English and German)

## Installation

1. Install the extension with composer:

```console
  composer require browserwerk/bw_jobs
```

2. Include the TypoScript template in the template module
3. Add the two plugins, Detail View and List View, to two separate pages
4. Configure the extension to your liking (see below for available constants)
5. Add these route enhancers to your site configuration:

```yaml
routeEnhancers:
  JobsDetail:
    type: Extbase
    limitToPages: [000] # Change this to the pid containing the detail view plugin
    extension: BwJobs
    plugin: Detail
    routes:
      - routePath: '/'
        _controller: 'Frontend::show'
      - routePath: '/{job_position_title}'
        _controller: 'Frontend::show'
        _arguments:
          job_position_title: jobPosition
      - routePath: '/{job_position_title}/apply'
        _controller: 'Frontend::apply'
        _arguments:
          job_position_title: jobPosition
    aspects:
      job_position_title:
        type: PersistedAliasMapper
        tableName: tx_bwjobs_domain_model_jobposition
        routeFieldName: slug
  JobsApi:
    type: Extbase
    extension: BwJobs
    plugin: Api
    routes:
      - routePath: '/api/jobPositions'
        _controller: 'Api::listJobPositions'
```

## Available TypoScript constants

**plugin.tx_bwjobs_detail.settings**

| Constant Name | Default Value | Description |
| ------ | --- | ----------- |
| formPersistenceIdentifier | EXT:bw_jobs/Resources/Private/Forms/jobApplication.form.yaml | The path to the form YAML used for rendering the frontend application form. |
| senderName | BW Jobs Extension | The name of the sender emails should be sent by. |
| senderAddress | bwjobs@example.com | The address emails should be sent from. |
| templateRootPath | EXT:bw_jobs/Resources/Private/Templates/ | The path Fluid templates are stored in. |
| partialRootPath | EXT:bw_jobs/Resources/Private/Partials/ | The path Fluid partials are stored in. |
| layoutRootPath | EXT:bw_jobs/Resources/Private/Layouts/ | The path Fluid layouts are stored in. |
| emailTemplateRootPath | EXT:bw_jobs/Resources/Private/Templates/Email/ | The path Fluid email templates are stored in. |
| emailLayoutRootPath | EXT:bw_jobs/Resources/Private/Layouts/Email/ | The path Fluid email layouts are stored in. |

**plugin.tx_bwjobs_list.settings**

| Constant Name | Default Value | Description |
| ------ | --- | ----------- |
| itemsPerPage | 10 | The maximum number of items per page. |
| templateRootPath | EXT:bw_jobs/Resources/Private/Templates/ | The path Fluid templates are stored in. |
| partialRootPath | EXT:bw_jobs/Resources/Private/Partials/ | The path Fluid partials are stored in. |
| layoutRootPath | EXT:bw_jobs/Resources/Private/Layouts/ | The path Fluid layouts are stored in. |

**module.tx_bwjobs_jobs.settings**

| Constant Name | Default Value | Description |
| ------ | --- | ----------- |
| storagePid | 1 | The pid of the page where entities should be stored on. |
| templateRootPath | EXT:bw_jobs/Resources/Private/Backend/Templates/ | The path Fluid templates are stored in. |
| partialRootPath | EXT:bw_jobs/Resources/Private/Backend/Partials/ | The path Fluid partials are stored in. |
| layoutRootPath | EXT:bw_jobs/Resources/Private/Backend/Layouts/ | The path Fluid layouts are stored in. |

## Introduction for editors

This extension ships with five different record types:

- Job Positions
- Employment Types
- Contact Persons
- Locations
- Categories

To create a **Job Position**, first create a **Location** and assign one or more **Contact Persons** to it. Then, create an **Employment Type**.
Lastly, create a **Job Position** and assign the created **Location** as well as the **Employment Type** to it. You can optionally create a **Category** and assign it to the **Job Position** as well.

## Translations

The following translations are available by default:

- English
- German

Contributions for adding additional languages are always welcome.

## Sitemap

Add the following TypoScript to output job positions in the TYPO3 sitemap:

```
plugin.tx_seo {
    config {
        xmlSitemap {
            sitemaps {
                jobs {
                    provider = TYPO3\CMS\Seo\XmlSitemap\RecordsXmlSitemapDataProvider
                    config {
                        table = tx_bwjobs_domain_model_jobposition
                        sortField = date_posted
                        lastModifiedField = tstamp
                        pid = 000 # Change this to the pid storing the job positions (same as storagePid)
                        url {
                            pageId = 000 # Change this to the pid containing the detail view plugin
                            fieldToParameterMap {
                                uid = tx_bwjobs_detail[jobPosition]
                            }
                            additionalGetParameters {
                                tx_bwjobs_detail.controller = Frontend
                                tx_bwjobs_detail.action = show
                            }
                            useCacheHash = 1
                        }
                    }
                }
            }
        }
    }
}
```

## Structured data

This extension outputs structured JSON-LD data for job positions.
If you wish to disable it, override the **Show** template and remove the bw:structuredData ViewHelper at the very bottom of this template.

## Overriding Fluid templates

To override the default Fluid templates used by the extension, simply set the following TypoScript constants to the desired paths:

```
# Detail view
plugin.tx_bwjobs_detail.view.templateRootPath = EXT:my_extension/Resources/Private/Templates/
plugin.tx_bwjobs_detail.view.partialRootPath = EXT:my_extension/Resources/Private/Partials/
plugin.tx_bwjobs_detail.view.layoutRootPath = EXT:my_extension/Resources/Private/Layouts/

# List view
plugin.tx_bwjobs_list.view.templateRootPath = EXT:my_extension/Resources/Private/Templates/
plugin.tx_bwjobs_list.view.partialRootPath = EXT:my_extension/Resources/Private/Partials/
plugin.tx_bwjobs_list.view.layoutRootPath = EXT:my_extension/Resources/Private/Layouts/

# Backend module
module.tx_bwjobs_jobs.view.templateRootPath = EXT:my_extension/Resources/Private/Backend/Templates/
module.tx_bwjobs_jobs.view.partialRootPath = EXT:my_extension/Resources/Private/Backend/Partials/
module.tx_bwjobs_jobs.view.layoutRootPath = EXT:my_extension/Resources/Private/Backend/Layouts/
```

> This will not completely disable the default templates, it just allows you to override them from your own extension. If you wish to add more than just one additional path, use the TypoScript setup for *plugin.tx_bwjobs_detail.view*, *plugin.tx_bwjobs_list.view* and *module.tx_bwjobs_jobs.view* instead.

## Customizing the default styles

The following CSS Custom Properties are available for you to override from your own stylesheet:

```css
:root {
    /* This is the font size used as base by the custom styling from this extension */
    --bw-jobs-font-size--base: 16px;

    /* You can override these custom properties to change the colors */
    --bw-jobs-color--primary: var(--bs-primary);
    --bw-jobs-color--light: var(--bs-light);
}
```

> Please note: Because of the usage of modern CSS features, the default styling is not compatible with Internet Explorer 11.

## Disabling the default styles

This extension ships with Bootstrap 5 and some additional custom styling.
To disable these styles, unset the includes via TypoScript:

```
page.includeCSSLibs.bwJobsBootstrap >
page.includeCSS.bwJobs >
```

## Customizing the emails

To customize the emails sent by this extension, set the following TypoScript constants to the desired paths in your own extension:

| Constant Name | Default Value | Description |
| ------ | --- | ----------- |
| emailTemplateRootPath | EXT:bw_jobs/Resources/Private/Templates/Email/ | The path Fluid email templates are stored in. |
| emailLayoutRootPath | EXT:bw_jobs/Resources/Private/Layouts/Email/ | The path Fluid email layouts are stored in. |

Make sure these files exist in the new template path:

- EmailToApplicant.html
- EmailToApplicant.txt
- EmailToContactPerson.html
- EmailToContactPerson.txt

You can copy theses files from Resources/Private/Templates/Email.

The new layout path can be kept empty, but you are free to add custom layouts there as well.

> The default application form is configured to use FluidEmail by default. If you want to change this, see below for instructions on how to customize the application form.

## Customizing the application form

You can override the default YAML used for rendering the application form by setting the following TypoScript constant to point to your own form definition YAML:

| Constant Name | Default Value | Description |
| ------ | --- | ----------- |
| formPersistenceIdentifier | EXT:bw_jobs/Resources/Private/Forms/jobApplication.form.yaml | The path to the form YAML used for rendering the frontend application form. |

> Make sure to take a look inside the default template in Resources/Private/Templates/Frontend/Apply.html to see which values are set dynamically from inside Fluid.

## Found a bug?

If you found a bug, [create an issue](https://github.com/BrowserwerkOfficial/bw-jobs/issues) with detailed steps for reproduction.

## About us

Browserwerk develops individual corporate websites and enterprise open source projects. Conception, consultation and implementation of tailor-made online and intranet solutions are part of the agency's core business. Short project times and fast release cycles play a decisive role here. The agency supports medium-sized and globally operating companies throughout Europe in the digitization of business processes. Agile working methods and best practices are used in the projects. By sharing issues from different angles, customers become long-term partners.

More about us on [our website](https://www.browserwerk.de/).

---

Icons by [Heroicons](https://heroicons.com/).

