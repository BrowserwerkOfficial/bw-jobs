/**
 * This file is part of the "BW Jobs" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Leon Seipp <l.seipp@browserwerk.de>, Browserwerk GmbH
 *
 * IMPORTANT: Run `npm run build` in the root of this extension to bundle this file
 * and its dependencies, which is then output to `Resources/Public/JavaScript`.
 *
 * @typedef Location
 * @type {object}
 * @property {number} uid
 * @property {string} title
 *
 * @typedef EmploymentType
 * @type {object}
 * @property {number} uid
 * @property {string} title
 * @property {string} type
 *
 * @typedef JobPosition
 * @type {object}
 * @property {number} uid
 * @property {string} slug
 * @property {string} title
 * @property {Location[]} locations
 * @property {EmploymentType[]} employmentTypes
 *
 * @typedef Filters
 * @type {object}
 * @property {?number} locationUid
 * @property {?number} categoryUid
 *
 * @typedef Data
 * @type {object}
 * @property {boolean} isFetching
 * @property {JobPosition[]} jobPositions
 * @property {number[]} pages
 * @property {number} currentPage
 * @property {Filters} filters
 */

import { html, render, svg } from 'uhtml';

/**
 * Strip a leading slash from a string.
 *
 * @param {string} string
 *
 * @return {string}
 */
function stripLeadingSlash(string) {
  return string.replace(/^\//, '');
}

/**
 * Strip a trailing slash from a string.
 *
 * @param {string} string
 *
 * @return {string}
 */
function stripTrailingSlash(string) {
  return string.replace(/\/$/, '');
}

/**
 * Join an array of conditional class names.
 *
 * @param {unknown[]} classNames
 *
 * @return {string}
 */
function cx(classNames) {
  return classNames.filter(Boolean).join(' ');
}

/**
 * Get an element from the DOM by selector
 * or fail if it does not exist.
 *
 * @param {string} selector
 *
 * @return {HTMLElement}
 */
function getElementOrFail(selector) {
  const element = document.querySelector(selector);

  if (!element) {
    throw new Error(`Missing element "${selector}"`);
  }

  return element;
}

/**
 * Build the request URL for data.
 * Appends filters as well as the current page as query params.
 *
 * @param {URL} url
 * @param {Data} data
 *
 * @return {URL}
 */
function buildRequestUrlForData(url, data) {
  // Add filter query params to URL
  Object.entries(data.filters).forEach(([filterKey, filterValue]) => {
    if (typeof filterValue === 'string') {
      url.searchParams.append(filterKey, filterValue);
    }
  });

  // Add page number query param to URL
  url.searchParams.append('currentPage', data.currentPage);

  return url;
}

/**
 * Persist a value to local storage.
 *
 * @param {string} key
 * @param {?string} value
 *
 * @return {void}
 */
function persistValueToLocalStorage(key, value) {
  if (value) {
    localStorage.setItem(key, value);
  } else {
    localStorage.removeItem(key);
  }
}

/**
 * Retrieve a value from local storage.
 *
 * @param {string} key
 *
 * @return {?string}
 */
function retrieveValueFromLocalStorage(key) {
  return localStorage.getItem(key);
}

/**
 * Clock icon component.
 *
 * @return {string}
 */
function ClockIcon() {
  return svg`
    <svg
      class="bw-jobs-list-item__icon"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
      viewBox="0 0 24 24"
    >
      <path
        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
    </svg>
  `;
}

/**
 * Marker icon component.
 *
 * @return {string}
 */
function MarkerIcon() {
  return svg`
    <svg
      class="bw-jobs-list-item__icon"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
      viewBox="0 0 24 24"
    >
      <path
        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
      <path
        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
    </svg>
  `;
}

/**
 * Spinner component.
 *
 * @return {string}
 */
function Spinner() {
  return html`
    <div class="bw-jobs-spinner">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  `;
}

/**
 * Pagination component.
 *
 * @param {number[]} pages
 * @param {number} currentPage
 * @param {(pageNumber: number) => void} onSelectPage
 *
 * @return {string}
 */
function Pagination(pages, currentPage, onSelectPage) {
  if (pages.length < 2) {
    return '';
  }

  return html`
    <ul class="bw-jobs-paginator">
      <li
        class=${cx([
          'bw-jobs-paginator__item bw-jobs-paginator__item--prev',
          currentPage === 1 && 'bw-jobs-paginator__item--disabled',
        ])}
      >
        <button
          class="bw-jobs-paginator__item-button"
          @click=${() => onSelectPage(Math.max(currentPage - 1, 1))}
        >
          <svg
            class="bw-jobs-paginator__item-icon"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
          >
            <path
              d="M11 19l-7-7 7-7m8 14l-7-7 7-7"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
      </li>
      ${pages.map((page) => {
        return html`<li
          class=${cx([
            'bw-jobs-paginator__item',
            page === currentPage && 'bw-jobs-paginator__item--current',
          ])}
        >
          <button
            class="bw-jobs-paginator__item-button"
            @click=${() => onSelectPage(page)}
          >
            ${page}
          </button>
        </li>`;
      })}
      <li
        class=${cx([
          'bw-jobs-paginator__item bw-jobs-paginator__item--next',
          currentPage === pages.length && 'bw-jobs-paginator__item--disabled',
        ])}
      >
        <button
          class="bw-jobs-paginator__item-button"
          @click=${() => onSelectPage(Math.min(currentPage + 1, pages.length))}
        >
          <svg
            class="bw-jobs-paginator__item-icon"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
          >
            <path
              d="M9 5l7 7-7 7"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
      </li>
    </ul>
  `;
}

/**
 * Employment types component.
 *
 * @param {EmploymentType[]} employmentTypes
 *
 * @return {string}
 */
function EmploymentTypes(employmentTypes) {
  if (!employmentTypes.length) {
    return '';
  }

  return html`<div class="bw-jobs-list-item__column">
    ${ClockIcon()} ${employmentTypes[0].title}
  </div>`;
}

/**
 * Locations component.
 *
 * @param {Location[]} locations
 *
 * @return {string}
 */
function Locations(locations) {
  if (!locations.length) {
    return '';
  }

  return html`<div
    class="bw-jobs-list-item__column bw-jobs-list-item__column--locations"
  >
    ${MarkerIcon()} ${locations.map((location) => location.title).join(', ')}
  </div>`;
}

/**
 * Job position component.
 *
 * @param {JobPosition} jobPosition
 * @param {string} url
 *
 * @return {string}
 */
function JobPosition({ title, employmentTypes, locations }, url) {
  return html`
    <a class="bw-jobs-list-item" href="${url}" title="${title}">
      <div class="bw-jobs-list-item__inner">
        <div class="bw-jobs-list-item__column bw-jobs-list-item__column--title">
          ${title}
        </div>
        ${EmploymentTypes(employmentTypes)} ${Locations(locations)}
      </div>
    </a>
  `;
}

/**
 * This class encapsulates the logic responsible
 * for fetching data and rendering the list view.
 *
 * @class JobsList
 */
class JobsList {
  /**
   * @type {?string}
   *
   * @private
   * @memberof JobsList
   */
  #mountElementSelector = null;

  /**
   * @type {?string}
   *
   * @private
   * @memberof JobsList
   */
  #locationFilterSelector = null;

  /**
   * @type {?string}
   *
   * @private
   * @memberof JobsList
   */
  #categoryFilterSelector = null;

  /**
   * @type {Data}
   *
   * @private
   * @memberof JobsList
   */
  #data = {
    isFetching: true,
    jobPositions: [],
    pages: [],
    currentPage: 1,
    filters: {
      locationUid: null,
      categoryUid: null,
    },
  };

  /**
   * @type {Data}
   *
   * @memberof JobsList
   */
  get data() {
    return this.#data;
  }

  /**
   * @property {Partial<Data>} data
   *
   * @return {void}
   *
   * @memberof JobsList
   */
  set data(data) {
    this.#data = { ...this.#data, ...data };
    this.render();
  }

  /**
   * @type {HTMLElement}
   *
   * @readonly
   * @memberof JobsList
   */
  get mountElement() {
    return getElementOrFail(this.#mountElementSelector);
  }

  /**
   * @type {Record<string, string>}
   *
   * @readonly
   * @memberof JobsList
   */
  get translations() {
    const { translations } = this.mountElement.dataset;

    return JSON.parse(translations || '{}');
  }

  /**
   * @type {URL}
   *
   * @readonly
   * @memberof JobsList
   */
  get endpointUrl() {
    const { endpoint } = this.mountElement.dataset;

    if (!endpoint) {
      throw new Error(
        `Missing "data-endpoint" attribute on the "${
          this.#mountElementSelector
        }" mount element`,
      );
    }

    return new URL(endpoint, window.location.origin);
  }

  /**
   * @type {URL}
   *
   * @readonly
   * @memberof JobsList
   */
  get detailPageUrl() {
    const { detailPagePath } = this.mountElement.dataset;

    if (!detailPagePath) {
      throw new Error(
        `Missing "data-detail-page-path" attribute on the "${
          this.#mountElementSelector
        }" mount element`,
      );
    }

    return new URL(stripTrailingSlash(detailPagePath), window.location.origin);
  }

  /**
   * Constructor
   *
   * @param {string} mountElementSelector
   * @param {string} locationFilterSelector
   * @param {string} categoryFilterSelector
   *
   * @memberof JobsList
   */
  constructor(
    mountElementSelector,
    locationFilterSelector,
    categoryFilterSelector,
  ) {
    if (!mountElementSelector) {
      throw new Error('Missing mountElementSelector');
    }

    if (!locationFilterSelector) {
      throw new Error('Missing locationFilterSelector');
    }

    if (!categoryFilterSelector) {
      throw new Error('Missing categoryFilterSelector');
    }

    this.#mountElementSelector = mountElementSelector;
    this.#locationFilterSelector = locationFilterSelector;
    this.#categoryFilterSelector = categoryFilterSelector;

    this.initLocationFilter();
    this.initCategoryFilter();
  }

  /**
   * Initialize the location filter.
   * Note: The filters are rendered from inside TYPO3 Fluid templates.
   *
   * @return {void}
   *
   * @memberof JobsList
   */
  initLocationFilter() {
    const selectElement = document.querySelector(this.#locationFilterSelector);

    selectElement?.addEventListener('change', ({ currentTarget }) => {
      persistValueToLocalStorage('jobsFilterLocationUid', currentTarget.value);

      this.data = {
        currentPage: 1,
        filters: {
          ...this.data.filters,
          locationUid: currentTarget.value,
        },
      };
      this.fetchData();
    });

    const storedValue = retrieveValueFromLocalStorage('jobsFilterLocationUid');
    if (storedValue && selectElement) {
      const isValidOption = selectElement.querySelector(
        `option[value="${storedValue}"]`,
      );

      if (!isValidOption) return;

      selectElement.value = storedValue;
      selectElement.dispatchEvent(new Event('change'));
    }
  }

  /**
   * Initialize the category filter.
   * Note: The filters are rendered from inside TYPO3 Fluid templates.
   *
   * @return {void}
   *
   * @memberof JobsList
   */
  initCategoryFilter() {
    const selectElement = document.querySelector(this.#categoryFilterSelector);

    selectElement?.addEventListener('change', ({ currentTarget }) => {
      persistValueToLocalStorage('jobsFilterCategoryUid', currentTarget.value);

      this.data = {
        currentPage: 1,
        filters: {
          ...this.data.filters,
          categoryUid: currentTarget.value,
        },
      };
      this.fetchData();
    });

    const storedValue = retrieveValueFromLocalStorage('jobsFilterCategoryUid');
    if (storedValue && selectElement) {
      const isValidOption = selectElement.querySelector(
        `option[value=${storedValue}]`,
      );

      if (!isValidOption) return;

      selectElement.value = storedValue;
      selectElement.dispatchEvent(new Event('change'));
    }
  }

  /**
   * @return {Promise<void>}
   *
   * @memberof JobsList
   */
  async fetchData() {
    this.data = { isFetching: true };

    const response = await fetch(
      buildRequestUrlForData(this.endpointUrl, this.data),
    );

    if (!response.ok) {
      throw new Error(response.statusText);
    }

    const { jobPositions, pages } = await response.json();

    this.data = {
      isFetching: false,
      jobPositions,
      pages,
    };
  }

  /**
   * The render function.
   * Automatically called on changes to `data`.
   *
   * @return {Promise<void>}
   *
   * @memberof JobsList
   */
  async render() {
    const { data } = this;

    // Render loading spinner when fetching
    if (data.isFetching) {
      render(
        this.mountElement,
        html`<div class="bw-jobs-list">
          <div class="bw-jobs-list__loader">${Spinner()}</div>
        </div>`,
      );
      return;
    }

    // Render message when no items to show
    if (!data.jobPositions.length) {
      const isFiltered = !!(
        data.filters.locationUid || data.filters.categoryUid
      );

      render(
        this.mountElement,
        html`<div class="bw-jobs-empty bw-jobs-body">
          ${this.translations[isFiltered ? 'nothingFound' : 'nothingPosted']}
        </div>`,
      );
      return;
    }

    render(
      this.mountElement,
      html`<div class="bw-jobs-list">
        ${data.jobPositions.map((jobPosition) => {
          const url = `${this.detailPageUrl}/${stripLeadingSlash(
            jobPosition.slug,
          )}`;

          return JobPosition(jobPosition, url);
        })}
        ${Pagination(data.pages, data.currentPage, (pageNumber) => {
          this.data = { currentPage: pageNumber };
          this.fetchData();
        })}
      </div>`,
    );
  }

  /**
   * @return {Promise<void>}
   *
   * @memberof JobsList
   */
  async mount() {
    this.fetchData();
  }
}

const jobsList = new JobsList(
  '#bw-jobs-list',
  '#bw-jobs-location-filter',
  '#bw-jobs-category-filter',
);
jobsList.mount();
