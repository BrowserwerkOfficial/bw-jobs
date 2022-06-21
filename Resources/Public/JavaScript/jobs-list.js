/* eslint-disable class-methods-use-this */
// eslint-disable-next-line import/no-unresolved
import { html, render, svg } from 'https://unpkg.com/uhtml?module';

/**
 * Global type definitions.
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
 */

/**
 * Get an element from the DOM by selector
 * or fail if it does not exist.
 *
 * @param {string} selector
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
 * Employment types component.
 *
 * @param {EmploymentType[]} employmentTypes
 *
 * @return {string|false}
 */
function EmploymentTypes(employmentTypes) {
  if (!employmentTypes.length) {
    return false;
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
 * @return {string|false}
 */
function Locations(locations) {
  if (!locations.length) {
    return false;
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
    <a class="bw-jobs-list-item" href="${url}" title="Test">
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
 * @class JobsList
 */
class JobsList {
  /**
   * @type {string|null}
   *
   * @private
   * @memberof JobsList
   */
  #mountElementSelector = null;

  /**
   * @type {boolean}
   *
   * @private
   * @memberof JobsList
   */
  #isFetching = true;

  /**
   * @type {JobPosition[]|null}
   *
   * @private
   * @memberof JobsList
   */
  #data = null;

  /**
   * @type {JobPosition[]|null}
   *
   * @memberof JobsList
   */
  get data() {
    return this.#data;
  }

  /**
   * @property {JobPosition[]|null} data
   * @returns {void}
   *
   * @memberof JobsList
   */
  set data(data) {
    this.#data = data;
    this.render();
  }

  /**
   * @type {HTMLElement}
   *
   * @readonly
   * @memberof JobsList
   */
  get mountElement() {
    const mountElement = document.querySelector(this.#mountElementSelector);

    if (!mountElement) {
      throw new Error(
        `Could not mount jobs list as the mount element "${
          this.#mountElementSelector
        }" is missing`,
      );
    }

    return mountElement;
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

    return new URL(detailPagePath, window.location.origin);
  }

  /**
   * Constructor
   *
   * @param {string} mountElementSelector
   */
  constructor(mountElementSelector) {
    if (!mountElementSelector) {
      throw new Error('Missing mountElementSelector');
    }

    this.#mountElementSelector = mountElementSelector;

    this.listenForLocationFilter();
    this.listenForCategoryFilter();
  }

  /**
   * Listen for changes on the location filter.
   * Note: The filters are rendered from inside TYPO3 Fluid templates.
   *
   * @returns {void}
   *
   * @memberof JobsList
   */
  listenForLocationFilter() {
    const selectElement = getElementOrFail('#bw-jobs-location-filter');

    selectElement.addEventListener('change', (event) => {
      // eslint-disable-next-line no-console
      console.log(event.currentTarget.value);
    });
  }

  /**
   * Listen for changes on the category filter.
   * Note: The filters are rendered from inside TYPO3 Fluid templates.
   *
   * @returns {void}
   *
   * @memberof JobsList
   */
  listenForCategoryFilter() {
    const selectElement = getElementOrFail('#bw-jobs-category-filter');

    selectElement.addEventListener('change', (event) => {
      // eslint-disable-next-line no-console
      console.log(event.currentTarget.value);
    });
  }

  /**
   * @returns {Promise<void>}
   *
   * @memberof JobsList
   */
  async fetchData() {
    this.#isFetching = true;

    const response = await fetch(this.endpointUrl);

    this.#isFetching = false;

    if (!response.ok) {
      throw new Error(response.statusText);
    }

    this.data = await response.json();
  }

  /**
   * @returns {Promise<void>}
   *
   * @memberof JobsList
   */
  async render() {
    if (this.#isFetching) {
      render(
        this.mountElement,
        html`<div class="bw-jobs-list">
          <div class="bw-jobs-list__loader">Loading</div>
        </div>`,
      );
      return;
    }

    render(
      this.mountElement,
      html`<div class="bw-jobs-list">
        ${this.data?.map((jobPosition) => {
          return JobPosition(
            jobPosition,
            // eslint-disable-next-line sonarjs/no-nested-template-literals
            `${this.detailPageUrl}/${jobPosition.slug}`,
          );
        })}
      </div>`,
    );
  }

  /**
   * @returns {Promise<void>}
   *
   * @memberof JobsList
   */
  async mount() {
    this.fetchData();
    this.render();
  }
}

const jobsList = new JobsList('#jobs-list');
await jobsList.mount();
