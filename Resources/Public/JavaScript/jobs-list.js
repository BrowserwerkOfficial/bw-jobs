var __defProp = Object.defineProperty;
var __defProps = Object.defineProperties;
var __getOwnPropDescs = Object.getOwnPropertyDescriptors;
var __getOwnPropSymbols = Object.getOwnPropertySymbols;
var __hasOwnProp = Object.prototype.hasOwnProperty;
var __propIsEnum = Object.prototype.propertyIsEnumerable;
var __defNormalProp = (obj, key, value) => key in obj ? __defProp(obj, key, { enumerable: true, configurable: true, writable: true, value }) : obj[key] = value;
var __spreadValues = (a, b) => {
  for (var prop in b || (b = {}))
    if (__hasOwnProp.call(b, prop))
      __defNormalProp(a, prop, b[prop]);
  if (__getOwnPropSymbols)
    for (var prop of __getOwnPropSymbols(b)) {
      if (__propIsEnum.call(b, prop))
        __defNormalProp(a, prop, b[prop]);
    }
  return a;
};
var __spreadProps = (a, b) => __defProps(a, __getOwnPropDescs(b));
var __accessCheck = (obj, member, msg) => {
  if (!member.has(obj))
    throw TypeError("Cannot " + msg);
};
var __privateGet = (obj, member, getter) => {
  __accessCheck(obj, member, "read from private field");
  return getter ? getter.call(obj) : member.get(obj);
};
var __privateAdd = (obj, member, value) => {
  if (member.has(obj))
    throw TypeError("Cannot add the same private member more than once");
  member instanceof WeakSet ? member.add(obj) : member.set(obj, value);
};
var __privateSet = (obj, member, value, setter) => {
  __accessCheck(obj, member, "write to private field");
  setter ? setter.call(obj, value) : member.set(obj, value);
  return value;
};
var _mountElementSelector, _locationFilterSelector, _categoryFilterSelector, _data;
import { r as render, h as html, s as svg } from "./vendor.js";
function cx(classNames) {
  return classNames.filter(Boolean).join(" ");
}
function getElementOrFail(selector) {
  const element = document.querySelector(selector);
  if (!element) {
    throw new Error(`Missing element "${selector}"`);
  }
  return element;
}
function buildRequestUrlForData(url, data) {
  Object.entries(data.filters).forEach(([filterKey, filterValue]) => {
    if (typeof filterValue === "string") {
      url.searchParams.append(filterKey, filterValue);
    }
  });
  url.searchParams.append("currentPage", data.currentPage);
  return url;
}
function persistValueToLocalStorage(key, value) {
  if (value) {
    localStorage.setItem(key, value);
  } else {
    localStorage.removeItem(key);
  }
}
function retrieveValueFromLocalStorage(key) {
  return localStorage.getItem(key);
}
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
function Pagination(pages, currentPage, onSelectPage) {
  if (pages.length < 2) {
    return "";
  }
  return html`
    <ul class="bw-jobs-paginator">
      <li
        class=${cx([
    "bw-jobs-paginator__item bw-jobs-paginator__item--prev",
    currentPage === 1 && "bw-jobs-paginator__item--disabled"
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
      "bw-jobs-paginator__item",
      page === currentPage && "bw-jobs-paginator__item--current"
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
    "bw-jobs-paginator__item bw-jobs-paginator__item--next",
    currentPage === pages.length && "bw-jobs-paginator__item--disabled"
  ])}
      >
        <button
          class="bw-jobs-paginator__item-button"
          @click=${() => onSelectPage(Math.max(currentPage + 1, pages.length))}
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
function EmploymentTypes(employmentTypes) {
  if (!employmentTypes.length) {
    return "";
  }
  return html`<div class="bw-jobs-list-item__column">
    ${ClockIcon()} ${employmentTypes[0].title}
  </div>`;
}
function Locations(locations) {
  if (!locations.length) {
    return "";
  }
  return html`<div
    class="bw-jobs-list-item__column bw-jobs-list-item__column--locations"
  >
    ${MarkerIcon()} ${locations.map((location) => location.title).join(", ")}
  </div>`;
}
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
class JobsList {
  constructor(mountElementSelector, locationFilterSelector, categoryFilterSelector) {
    __privateAdd(this, _mountElementSelector, null);
    __privateAdd(this, _locationFilterSelector, null);
    __privateAdd(this, _categoryFilterSelector, null);
    __privateAdd(this, _data, {
      isFetching: true,
      jobPositions: [],
      pages: [],
      currentPage: 1,
      filters: {
        locationUid: null,
        categoryUid: null
      }
    });
    if (!mountElementSelector) {
      throw new Error("Missing mountElementSelector");
    }
    if (!locationFilterSelector) {
      throw new Error("Missing locationFilterSelector");
    }
    if (!categoryFilterSelector) {
      throw new Error("Missing categoryFilterSelector");
    }
    __privateSet(this, _mountElementSelector, mountElementSelector);
    __privateSet(this, _locationFilterSelector, locationFilterSelector);
    __privateSet(this, _categoryFilterSelector, categoryFilterSelector);
    this.initLocationFilter();
    this.initCategoryFilter();
  }
  get data() {
    return __privateGet(this, _data);
  }
  set data(data) {
    __privateSet(this, _data, __spreadValues(__spreadValues({}, __privateGet(this, _data)), data));
    this.render();
  }
  get mountElement() {
    return getElementOrFail(__privateGet(this, _mountElementSelector));
  }
  get translations() {
    const { translations } = this.mountElement.dataset;
    return JSON.parse(translations || "{}");
  }
  get endpointUrl() {
    const { endpoint } = this.mountElement.dataset;
    if (!endpoint) {
      throw new Error(`Missing "data-endpoint" attribute on the "${__privateGet(this, _mountElementSelector)}" mount element`);
    }
    return new URL(endpoint, window.location.origin);
  }
  get detailPageUrl() {
    const { detailPagePath } = this.mountElement.dataset;
    if (!detailPagePath) {
      throw new Error(`Missing "data-detail-page-path" attribute on the "${__privateGet(this, _mountElementSelector)}" mount element`);
    }
    return new URL(detailPagePath, window.location.origin);
  }
  initLocationFilter() {
    const selectElement = document.querySelector(__privateGet(this, _locationFilterSelector));
    selectElement == null ? void 0 : selectElement.addEventListener("change", ({ currentTarget }) => {
      persistValueToLocalStorage("jobsFilterLocationUid", currentTarget.value);
      this.data = {
        currentPage: 1,
        filters: __spreadProps(__spreadValues({}, this.data.filters), {
          locationUid: currentTarget.value
        })
      };
      this.fetchData();
    });
    const storedValue = retrieveValueFromLocalStorage("jobsFilterLocationUid");
    if (storedValue) {
      selectElement.value = storedValue;
      selectElement.dispatchEvent(new Event("change"));
    }
  }
  initCategoryFilter() {
    const selectElement = document.querySelector(__privateGet(this, _categoryFilterSelector));
    selectElement == null ? void 0 : selectElement.addEventListener("change", ({ currentTarget }) => {
      persistValueToLocalStorage("jobsFilterCategoryUid", currentTarget.value);
      this.data = {
        currentPage: 1,
        filters: __spreadProps(__spreadValues({}, this.data.filters), {
          categoryUid: currentTarget.value
        })
      };
      this.fetchData();
    });
    const storedValue = retrieveValueFromLocalStorage("jobsFilterCategoryUid");
    if (storedValue) {
      selectElement.value = storedValue;
      selectElement.dispatchEvent(new Event("change"));
    }
  }
  async fetchData() {
    this.data = { isFetching: true };
    const response = await fetch(buildRequestUrlForData(this.endpointUrl, this.data));
    if (!response.ok) {
      throw new Error(response.statusText);
    }
    const { jobPositions, pages } = await response.json();
    this.data = {
      isFetching: false,
      jobPositions,
      pages
    };
  }
  async render() {
    const { data } = this;
    if (data.isFetching) {
      render(this.mountElement, html`<div class="bw-jobs-list">
          <div class="bw-jobs-list__loader">${Spinner()}</div>
        </div>`);
      return;
    }
    if (!data.jobPositions.length) {
      const isFiltered = !!(data.filters.locationUid || data.filters.categoryUid);
      render(this.mountElement, html`<div class="bw-jobs-empty bw-jobs-body">
          ${this.translations[isFiltered ? "nothingFound" : "nothingPosted"]}
        </div>`);
      return;
    }
    render(this.mountElement, html`<div class="bw-jobs-list">
        ${data.jobPositions.map((jobPosition) => JobPosition(jobPosition, `${this.detailPageUrl}/${jobPosition.slug}`))}
        ${Pagination(data.pages, data.currentPage, (pageNumber) => {
      this.data = { currentPage: pageNumber };
      this.fetchData();
    })}
      </div>`);
  }
  async mount() {
    this.fetchData();
  }
}
_mountElementSelector = new WeakMap();
_locationFilterSelector = new WeakMap();
_categoryFilterSelector = new WeakMap();
_data = new WeakMap();
const jobsList = new JobsList("#bw-jobs-list", "#bw-jobs-location-filter", "#bw-jobs-category-filter");
jobsList.mount();
