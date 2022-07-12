<?php

declare(strict_types=1);

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

return [
    'ctrl' => [
        'title' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,slug,teaser,description,required_education,required_experience,required_qualifications,required_responsibilities,required_skills,required_commitments,benefits,currency,payment_cycle,level',
        'iconfile' => 'EXT:bw_jobs/Resources/Public/Icons/tx_bwjobs_domain_model_jobposition.jpg',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                title,
                slug,
                teaser,
                description,
                --palette--;;possibilities,
                level,
                --palette--;;dates,
                locations,
                categories,

                --div--;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_tabs.xlf:employment,
                work_hours,
                employment_types,

                --div--;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_tabs.xlf:pay,
                salary,
                currency,
                payment_cycle,

                --div--;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_tabs.xlf:requirements,
                education_categories,
                required_education,
                required_experience,
                required_qualifications,
                required_responsibilities,
                required_skills,
                required_commitments,
                benefits,

                --div--;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_tabs.xlf:seo,
                seo_title,
                seo_description,
                og_title,
                og_description,
                og_image,
                twitter_title,
                twitter_description,
                twitter_image,
                twitter_card,

                --div--;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_tabs.xlf:visibility,
                homeoffice_public,
                salary_public,
                employment_types_public,
                categories_public,
                headlines_visible,

                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                sys_language_uid,
                l10n_parent,
                l10n_diffsource,

                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                hidden,
                starttime,
                endtime
            ',
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_bwjobs_domain_model_jobposition',
                'foreign_table_where' => 'AND {#tx_bwjobs_domain_model_jobposition}.{#pid}=###CURRENT_PID### AND {#tx_bwjobs_domain_model_jobposition}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required,trim,uniqueInPid',
                'default' => '',
            ],
        ],
        'slug' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                    'fieldSeparator' => '/',
                    'prefixParentPageSlug' => true,
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => '',
            ],
        ],
        'teaser' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.teaser',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'education_categories' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.education_categories',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectCheckBox',
                'items' => [
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.education_categories_high_school', 'high school'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.education_categories_associate', 'associate degree'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.education_categories_bachelor', 'bachelor degree'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.education_categories_postgraduate', 'postgraduate degree'],
                ],
                'default' => '',
            ],
        ],
        'required_education' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.required_education',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'required_experience' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.required_experience',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'required_qualifications' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.required_qualifications',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'required_responsibilities' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.required_responsibilities',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'required_skills' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.required_skills',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'required_commitments' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.required_commitments',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'benefits' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.benefits',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'work_hours' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.work_hours',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 40,
                'range' => [
                    'lower' => 0,
                    'upper' => 48,
                ],
            ],
        ],
        'start_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.start_date',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 7,
                'eval' => 'required,date',
                'default' => time(),
            ],
        ],
        'valid_through_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.valid_through_date',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 7,
                'eval' => 'date',
                'default' => null,
            ],
        ],
        'salary_public' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.salary_public',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'labelUnchecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.salary_public_no',
                        'labelChecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.salary_public_yes',
                    ],
                ],
                'default' => 0,
            ],
        ],
        'salary' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.salary',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'range' => [
                    'lower' => 0,
                ],
                'default' => 0,
            ],
        ],
        'homeoffice_public' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.homeoffice_public',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'labelUnchecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.homeoffice_public_no',
                        'labelChecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.homeoffice_public_yes',
                    ],
                ],
                'default' => 0,
            ],
        ],
        'homeoffice_possible' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.homeoffice_possible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'labelUnchecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.homeoffice_possible_no',
                        'labelChecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.homeoffice_possible_yes',
                    ],
                ],
                'default' => 0,
            ],
        ],
        'direct_application_possible' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.direct_application_possible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'labelUnchecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.direct_application_possible_no',
                        'labelChecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.direct_application_possible_yes',
                    ],
                ],
                'default' => 0,
            ],
        ],
        'currency' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_afa', 'AFA'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_all', 'ALL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_dzd', 'DZD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_aoa', 'AOA'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ars', 'ARS'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_amd', 'AMD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_awg', 'AWG'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_aud', 'AUD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_azn', 'AZN'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bsd', 'BSD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bhd', 'BHD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bdt', 'BDT'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bbd', 'BBD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_byr', 'BYR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bef', 'BEF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bzd', 'BZD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bmd', 'BMD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_btn', 'BTN'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_btc', 'BTC'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bob', 'BOB'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bam', 'BAM'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bwp', 'BWP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_brl', 'BRL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_gbp', 'GBP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bnd', 'BND'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bgn', 'BGN'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_bif', 'BIF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_khr', 'KHR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_cad', 'CAD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_cve', 'CVE'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_kyd', 'KYD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_xof', 'XOF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_xaf', 'XAF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_xpf', 'XPF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_clp', 'CLP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_cny', 'CNY'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_cop', 'COP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_kmf', 'KMF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_cdf', 'CDF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_crc', 'CRC'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_hrk', 'HRK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_cuc', 'CUC'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_czk', 'CZK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_dkk', 'DKK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_djf', 'DJF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_dop', 'DOP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_xcd', 'XCD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_egp', 'EGP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ern', 'ERN'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_eek', 'EEK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_etb', 'ETB'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_eur', 'EUR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_fkp', 'FKP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_fjd', 'FJD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_gmd', 'GMD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_gel', 'GEL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ghs', 'GHS'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_gip', 'GIP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_grd', 'GRD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_gtq', 'GTQ'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_gnf', 'GNF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_gyd', 'GYD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_htg', 'HTG'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_hnl', 'HNL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_hkd', 'HKD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_huf', 'HUF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_isk', 'ISK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_inr', 'INR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_idr', 'IDR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_irr', 'IRR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_iqd', 'IQD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ils', 'ILS'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_itl', 'ITL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_jmd', 'JMD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_jpy', 'JPY'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_jod', 'JOD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_kzt', 'KZT'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_kes', 'KES'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_kwd', 'KWD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_kgs', 'KGS'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_lak', 'LAK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_lvl', 'LVL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_lbp', 'LBP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_lsl', 'LSL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_lrd', 'LRD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_lyd', 'LYD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ltl', 'LTL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mop', 'MOP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mkd', 'MKD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mga', 'MGA'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mwk', 'MWK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_myr', 'MYR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mvr', 'MVR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mro', 'MRO'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mur', 'MUR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mxn', 'MXN'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mdl', 'MDL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mnt', 'MNT'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mad', 'MAD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mzm', 'MZM'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_mmk', 'MMK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_nad', 'NAD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_npr', 'NPR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ang', 'ANG'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_twd', 'TWD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_nzd', 'NZD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_nio', 'NIO'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ngn', 'NGN'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_kpw', 'KPW'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_nok', 'NOK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_omr', 'OMR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_pkr', 'PKR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_pab', 'PAB'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_pgk', 'PGK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_pyg', 'PYG'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_pen', 'PEN'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_php', 'PHP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_pln', 'PLN'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_qar', 'QAR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ron', 'RON'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_rub', 'RUB'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_rwf', 'RWF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_svc', 'SVC'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_wst', 'WST'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_sar', 'SAR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_rsd', 'RSD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_scr', 'SCR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_sll', 'SLL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_sgd', 'SGD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_skk', 'SKK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_sbd', 'SBD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_sos', 'SOS'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_zar', 'ZAR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_krw', 'KRW'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_xdr', 'XDR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_lkr', 'LKR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_shp', 'SHP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_sdg', 'SDG'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_srd', 'SRD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_szl', 'SZL'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_sek', 'SEK'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_chf', 'CHF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_syp', 'SYP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_std', 'STD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_tjs', 'TJS'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_tzs', 'TZS'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_thb', 'THB'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_top', 'TOP'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ttd', 'TTD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_tnd', 'TND'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_try', 'TRY'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_tmt', 'TMT'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_ugx', 'UGX'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_uah', 'UAH'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_aed', 'AED'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_uyu', 'UYU'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_usd', 'USD'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_uzs', 'UZS'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_vuv', 'VUV'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_vef', 'VEF'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_vnd', 'VND'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_yer', 'YER'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.currency_zmk', 'ZMK'],
                ],
                'default' => 'EUR',
                'eval' => 'required',
            ],
        ],
        'payment_cycle' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.payment_cycle',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.payment_cycle_hourly', 'HOURLY'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.payment_cycle_daily', 'DAILY'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.payment_cycle_monthly', 'MONTHLY'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.payment_cycle_yearly', 'YEARLY'],
                ],
                'default' => 'MONTHLY',
                'eval' => 'required',
            ],
        ],
        'level' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.level',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.level_junior', 'JUNIOR'],
                    ['LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.level_senior', 'SENIOR'],
                ],
                'eval' => 'required',
            ],
        ],
        'date_posted' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.date_posted',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 7,
                'eval' => 'required,date',
                'default' => time(),
            ],
        ],
        'seo_title' => [
            'exclude' => true,
            'l10n_mode' => 'prefixLangTitle',
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.seo_title',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'seo_description' => [
            'exclude' => true,
            'l10n_mode' => 'prefixLangTitle',
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.seo_description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 3,
            ],
        ],
        'og_title' => [
            'exclude' => true,
            'l10n_mode' => 'prefixLangTitle',
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.og_title',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'og_description' => [
            'exclude' => true,
            'l10n_mode' => 'prefixLangTitle',
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.og_description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 3,
            ],
        ],
        'og_image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.og_image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'og_image',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                    ],
                    'foreign_types' => [
                        '0' => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette',
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette',
                        ],
                    ],
                    'maxitems' => 1
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'twitter_title' => [
            'exclude' => true,
            'l10n_mode' => 'prefixLangTitle',
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.twitter_title',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'twitter_description' => [
            'exclude' => true,
            'l10n_mode' => 'prefixLangTitle',
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.twitter_description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 3,
            ],
        ],
        'twitter_image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.twitter_image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'twitter_image',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'foreign_types' => [
                        '0' => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ]
                    ],
                    'maxitems' => 1
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'twitter_card' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.twitter_card',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['summary', 'summary'],
                    ['summary_large_image', 'summary_large_image'],
                ],
                'eval' => 'required'
            ],
        ],
        'employment_types_public' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.employment_types_public',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'labelUnchecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.employment_types_public_no',
                        'labelChecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.employment_types_public_yes',
                    ],
                ],
                'default' => 0,
            ],
        ],
        'employment_types' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.employment_types',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bwjobs_domain_model_employmenttype',
                'foreign_table_where' => ' AND tx_bwjobs_domain_model_employmenttype.sys_language_uid = ###REC_FIELD_sys_language_uid###',
                'MM' => 'tx_bwjobs_jobposition_employmenttype_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'minitems' => 1,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
        ],
        'locations' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.locations',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bwjobs_domain_model_location',
                'foreign_table_where' => ' AND tx_bwjobs_domain_model_location.sys_language_uid = ###REC_FIELD_sys_language_uid###',
                'MM' => 'tx_bwjobs_jobposition_location_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'minitems' => 1,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
        ],
        'categories_public' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.categories_public',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'labelUnchecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.categories_public_no',
                        'labelChecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.categories_public_yes',
                    ],
                ],
                'default' => 0,
            ],
        ],
        'categories' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.categories',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bwjobs_domain_model_category',
                'foreign_table_where' => ' AND tx_bwjobs_domain_model_category.sys_language_uid = ###REC_FIELD_sys_language_uid###',
                'MM' => 'tx_bwjobs_jobposition_category_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'minitems' => 0,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
        ],
        'headlines_visible' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.headlines_visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'labelUnchecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.headlines_visible_no',
                        'labelChecked' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.headlines_visible_yes',
                    ],
                ],
                'default' => 0,
            ],
        ],
    ],
    'palettes' => [
        'dates' => [
            'showitem' => '
                start_date;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.start_date,
                date_posted;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.date_posted,
                valid_through_date;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.valid_through_date
            ',
        ],
        'possibilities' => [
            'showitem' => '
                homeoffice_possible;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.homeoffice_possible,
                direct_application_possible;LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_jobposition.direct_application_possible
            ',
        ],
    ],
];
