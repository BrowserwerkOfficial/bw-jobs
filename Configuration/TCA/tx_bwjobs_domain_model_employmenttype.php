<?php

declare(strict_types=1);

/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 */

return [
    'ctrl' => [
        'title' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,description,type',
        'iconfile' => 'EXT:bw_jobs/Resources/Public/Icons/tx_bwjobs_domain_model_employmenttype.jpg',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                title,
                description,
                type,

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
                    [
                        'label' => '',
                        'value' => 0,
                    ],
                ],
                'foreign_table' => 'tx_bwjobs_domain_model_employmenttype',
                'foreign_table_where' => 'AND {#tx_bwjobs_domain_model_employmenttype}.{#pid}=###CURRENT_PID### AND {#tx_bwjobs_domain_model_employmenttype}.{#sys_language_uid} IN (-1,0)',
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
                'default' => 0,
                'items' => [
                    [
                        'label' => '',
                        'value' => 'invertStateDisplay',
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly',
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,uniqueInPid',
                'required' => true,
                'default' => '',
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.description',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'eval' => 'trim',
                'default' => '',
            ],
        ],
        'type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type_full_time',
                        'value' => 'FULL_TIME',
                    ],
                    [
                        'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type_part_time',
                        'value' => 'PART_TIME',
                    ],
                    [
                        'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type_contractor',
                        'value' => 'CONTRACTOR',
                    ],
                    [
                        'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type_intern',
                        'value' => 'INTERN',
                    ],
                    [
                        'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type_volunteer',
                        'value' => 'VOLUNTEER',
                    ],
                    [
                        'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type_per_diem',
                        'value' => 'PER_DIEM',
                    ],
                    [
                        'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type_temporary',
                        'value' => 'TEMPORARY',
                    ],
                    [
                        'label' => 'LLL:EXT:bw_jobs/Resources/Private/Language/locallang_db.xlf:tx_bwjobs_domain_model_employmenttype.type_other',
                        'value' => 'OTHER',
                    ],
                ],
                'required' => true,
            ],
        ],
    ],
];
