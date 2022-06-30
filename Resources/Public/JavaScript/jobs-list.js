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
var __privateSet = (obj, member, value, setter2) => {
  __accessCheck(obj, member, "write to private field");
  setter2 ? setter2.call(obj, value) : member.set(obj, value);
  return value;
};
var _mountElementSelector, _locationFilterSelector, _categoryFilterSelector, _data;
var MapSet = class extends Map {
  set(key, value) {
    super.set(key, value);
    return value;
  }
};
var WeakMapSet = class extends WeakMap {
  set(key, value) {
    super.set(key, value);
    return value;
  }
};
var empty = /^(?:area|base|br|col|embed|hr|img|input|keygen|link|menuitem|meta|param|source|track|wbr)$/i;
var elements = /<([a-z]+[a-z0-9:._-]*)([^>]*?)(\/?)>/g;
var attributes = /([^\s\\>"'=]+)\s*=\s*(['"]?)\x01/g;
var holes = /[\x01\x02]/g;
var esm_default = (template, prefix2, svg2) => {
  let i = 0;
  return template.join("").trim().replace(elements, (_, name, attrs, selfClosing) => {
    let ml = name + attrs.replace(attributes, "=$2$1").trimEnd();
    if (selfClosing.length)
      ml += svg2 || empty.test(name) ? " /" : "></" + name;
    return "<" + ml + ">";
  }).replace(holes, (hole) => hole === "" ? "<!--" + prefix2 + i++ + "-->" : prefix2 + i++);
};
var ELEMENT_NODE = 1;
var nodeType = 111;
var remove = ({ firstChild, lastChild }) => {
  const range = document.createRange();
  range.setStartAfter(firstChild);
  range.setEndAfter(lastChild);
  range.deleteContents();
  return firstChild;
};
var diffable = (node, operation) => node.nodeType === nodeType ? 1 / operation < 0 ? operation ? remove(node) : node.lastChild : operation ? node.valueOf() : node.firstChild : node;
var persistent = (fragment) => {
  const { firstChild, lastChild } = fragment;
  if (firstChild === lastChild)
    return lastChild || fragment;
  const { childNodes } = fragment;
  const nodes = [...childNodes];
  return {
    ELEMENT_NODE,
    nodeType,
    firstChild,
    lastChild,
    valueOf() {
      if (childNodes.length !== nodes.length)
        fragment.append(...nodes);
      return fragment;
    }
  };
};
var { isArray } = Array;
var aria = (node) => (values) => {
  for (const key in values) {
    const name = key === "role" ? key : `aria-${key}`;
    const value = values[key];
    if (value == null)
      node.removeAttribute(name);
    else
      node.setAttribute(name, value);
  }
};
var attribute = (node, name) => {
  let oldValue, orphan = true;
  const attributeNode = document.createAttributeNS(null, name);
  return (newValue) => {
    if (oldValue !== newValue) {
      oldValue = newValue;
      if (oldValue == null) {
        if (!orphan) {
          node.removeAttributeNode(attributeNode);
          orphan = true;
        }
      } else {
        const value = newValue;
        if (value == null) {
          if (!orphan)
            node.removeAttributeNode(attributeNode);
          orphan = true;
        } else {
          attributeNode.value = value;
          if (orphan) {
            node.setAttributeNodeNS(attributeNode);
            orphan = false;
          }
        }
      }
    }
  };
};
var boolean = (node, key, oldValue) => (newValue) => {
  if (oldValue !== !!newValue) {
    if (oldValue = !!newValue)
      node.setAttribute(key, "");
    else
      node.removeAttribute(key);
  }
};
var data = ({ dataset }) => (values) => {
  for (const key in values) {
    const value = values[key];
    if (value == null)
      delete dataset[key];
    else
      dataset[key] = value;
  }
};
var event = (node, name) => {
  let oldValue, lower, type = name.slice(2);
  if (!(name in node) && (lower = name.toLowerCase()) in node)
    type = lower.slice(2);
  return (newValue) => {
    const info = isArray(newValue) ? newValue : [newValue, false];
    if (oldValue !== info[0]) {
      if (oldValue)
        node.removeEventListener(type, oldValue, info[1]);
      if (oldValue = info[0])
        node.addEventListener(type, oldValue, info[1]);
    }
  };
};
var ref = (node) => {
  let oldValue;
  return (value) => {
    if (oldValue !== value) {
      oldValue = value;
      if (typeof value === "function")
        value(node);
      else
        value.current = node;
    }
  };
};
var setter = (node, key) => key === "dataset" ? data(node) : (value) => {
  node[key] = value;
};
var text = (node) => {
  let oldValue;
  return (newValue) => {
    if (oldValue != newValue) {
      oldValue = newValue;
      node.textContent = newValue == null ? "" : newValue;
    }
  };
};
var esm_default2 = (parentNode, a, b, get, before) => {
  const bLength = b.length;
  let aEnd = a.length;
  let bEnd = bLength;
  let aStart = 0;
  let bStart = 0;
  let map = null;
  while (aStart < aEnd || bStart < bEnd) {
    if (aEnd === aStart) {
      const node = bEnd < bLength ? bStart ? get(b[bStart - 1], -0).nextSibling : get(b[bEnd - bStart], 0) : before;
      while (bStart < bEnd)
        parentNode.insertBefore(get(b[bStart++], 1), node);
    } else if (bEnd === bStart) {
      while (aStart < aEnd) {
        if (!map || !map.has(a[aStart]))
          parentNode.removeChild(get(a[aStart], -1));
        aStart++;
      }
    } else if (a[aStart] === b[bStart]) {
      aStart++;
      bStart++;
    } else if (a[aEnd - 1] === b[bEnd - 1]) {
      aEnd--;
      bEnd--;
    } else if (a[aStart] === b[bEnd - 1] && b[bStart] === a[aEnd - 1]) {
      const node = get(a[--aEnd], -1).nextSibling;
      parentNode.insertBefore(get(b[bStart++], 1), get(a[aStart++], -1).nextSibling);
      parentNode.insertBefore(get(b[--bEnd], 1), node);
      a[aEnd] = b[bEnd];
    } else {
      if (!map) {
        map = /* @__PURE__ */ new Map();
        let i = bStart;
        while (i < bEnd)
          map.set(b[i], i++);
      }
      if (map.has(a[aStart])) {
        const index = map.get(a[aStart]);
        if (bStart < index && index < bEnd) {
          let i = aStart;
          let sequence = 1;
          while (++i < aEnd && i < bEnd && map.get(a[i]) === index + sequence)
            sequence++;
          if (sequence > index - bStart) {
            const node = get(a[aStart], 0);
            while (bStart < index)
              parentNode.insertBefore(get(b[bStart++], 1), node);
          } else {
            parentNode.replaceChild(get(b[bStart++], 1), get(a[aStart++], -1));
          }
        } else
          aStart++;
      } else
        parentNode.removeChild(get(a[aStart++], -1));
    }
  }
  return b;
};
var { isArray: isArray2, prototype } = Array;
var { indexOf: indexOf2 } = prototype;
var {
  createDocumentFragment,
  createElement,
  createElementNS,
  createTextNode,
  createTreeWalker,
  importNode
} = new Proxy(document, {
  get: (target, method) => target[method].bind(target)
});
var createHTML = (html2) => {
  const template = createElement("template");
  template.innerHTML = html2;
  return template.content;
};
var xml;
var createSVG = (svg2) => {
  if (!xml)
    xml = createElementNS("http://www.w3.org/2000/svg", "svg");
  xml.innerHTML = svg2;
  const content = createDocumentFragment();
  content.append(...xml.childNodes);
  return content;
};
var createContent = (text2, svg2) => svg2 ? createSVG(text2) : createHTML(text2);
var reducePath = ({ childNodes }, i) => childNodes[i];
var diff = (comment, oldNodes, newNodes) => esm_default2(comment.parentNode, oldNodes, newNodes, diffable, comment);
var handleAnything = (comment) => {
  let oldValue, text2, nodes = [];
  const anyContent = (newValue) => {
    switch (typeof newValue) {
      case "string":
      case "number":
      case "boolean":
        if (oldValue !== newValue) {
          oldValue = newValue;
          if (!text2)
            text2 = createTextNode("");
          text2.data = newValue;
          nodes = diff(comment, nodes, [text2]);
        }
        break;
      case "object":
      case "undefined":
        if (newValue == null) {
          if (oldValue != newValue) {
            oldValue = newValue;
            nodes = diff(comment, nodes, []);
          }
          break;
        }
        if (isArray2(newValue)) {
          oldValue = newValue;
          if (newValue.length === 0)
            nodes = diff(comment, nodes, []);
          else if (typeof newValue[0] === "object")
            nodes = diff(comment, nodes, newValue);
          else
            anyContent(String(newValue));
          break;
        }
        if (oldValue !== newValue && "ELEMENT_NODE" in newValue) {
          oldValue = newValue;
          nodes = diff(comment, nodes, newValue.nodeType === 11 ? [...newValue.childNodes] : [newValue]);
        }
        break;
      case "function":
        anyContent(newValue(comment));
        break;
    }
  };
  return anyContent;
};
var handleAttribute = (node, name) => {
  switch (name[0]) {
    case "?":
      return boolean(node, name.slice(1), false);
    case ".":
      return setter(node, name.slice(1));
    case "@":
      return event(node, "on" + name.slice(1));
    case "o":
      if (name[1] === "n")
        return event(node, name);
  }
  switch (name) {
    case "ref":
      return ref(node);
    case "aria":
      return aria(node);
  }
  return attribute(node, name);
};
function handlers(options) {
  const { type, path } = options;
  const node = path.reduceRight(reducePath, this);
  return type === "node" ? handleAnything(node) : type === "attr" ? handleAttribute(node, options.name) : text(node);
}
var createPath = (node) => {
  const path = [];
  let { parentNode } = node;
  while (parentNode) {
    path.push(indexOf2.call(parentNode.childNodes, node));
    node = parentNode;
    ({ parentNode } = node);
  }
  return path;
};
var prefix = "is\xB5";
var cache = new WeakMapSet();
var textOnly = /^(?:textarea|script|style|title|plaintext|xmp)$/;
var createCache = () => ({
  stack: [],
  entry: null,
  wire: null
});
var createEntry = (type, template) => {
  const { content, updates } = mapUpdates(type, template);
  return { type, template, content, updates, wire: null };
};
var mapTemplate = (type, template) => {
  const svg2 = type === "svg";
  const text2 = esm_default(template, prefix, svg2);
  const content = createContent(text2, svg2);
  const tw = createTreeWalker(content, 1 | 128);
  const nodes = [];
  const length = template.length - 1;
  let i = 0;
  let search = `${prefix}${i}`;
  while (i < length) {
    const node = tw.nextNode();
    if (!node)
      throw `bad template: ${text2}`;
    if (node.nodeType === 8) {
      if (node.data === search) {
        nodes.push({ type: "node", path: createPath(node) });
        search = `${prefix}${++i}`;
      }
    } else {
      while (node.hasAttribute(search)) {
        nodes.push({
          type: "attr",
          path: createPath(node),
          name: node.getAttribute(search)
        });
        node.removeAttribute(search);
        search = `${prefix}${++i}`;
      }
      if (textOnly.test(node.localName) && node.textContent.trim() === `<!--${search}-->`) {
        node.textContent = "";
        nodes.push({ type: "text", path: createPath(node) });
        search = `${prefix}${++i}`;
      }
    }
  }
  return { content, nodes };
};
var mapUpdates = (type, template) => {
  const { content, nodes } = cache.get(template) || cache.set(template, mapTemplate(type, template));
  const fragment = importNode(content, true);
  const updates = nodes.map(handlers, fragment);
  return { content: fragment, updates };
};
var unroll = (info, { type, template, values }) => {
  const length = unrollValues(info, values);
  let { entry } = info;
  if (!entry || (entry.template !== template || entry.type !== type))
    info.entry = entry = createEntry(type, template);
  const { content, updates, wire } = entry;
  for (let i = 0; i < length; i++)
    updates[i](values[i]);
  return wire || (entry.wire = persistent(content));
};
var unrollValues = ({ stack }, values) => {
  const { length } = values;
  for (let i = 0; i < length; i++) {
    const hole = values[i];
    if (hole instanceof Hole)
      values[i] = unroll(stack[i] || (stack[i] = createCache()), hole);
    else if (isArray2(hole))
      unrollValues(stack[i] || (stack[i] = createCache()), hole);
    else
      stack[i] = null;
  }
  if (length < stack.length)
    stack.splice(length);
  return length;
};
var Hole = class {
  constructor(type, template, values) {
    this.type = type;
    this.template = template;
    this.values = values;
  }
};
var tag = (type) => {
  const keyed = new WeakMapSet();
  const fixed = (cache3) => (template, ...values) => unroll(cache3, { type, template, values });
  return Object.assign((template, ...values) => new Hole(type, template, values), {
    for(ref2, id) {
      const memo = keyed.get(ref2) || keyed.set(ref2, new MapSet());
      return memo.get(id) || memo.set(id, fixed(createCache()));
    },
    node: (template, ...values) => unroll(createCache(), new Hole(type, template, values)).valueOf()
  });
};
var cache2 = new WeakMapSet();
var render = (where, what) => {
  const hole = typeof what === "function" ? what() : what;
  const info = cache2.get(where) || cache2.set(where, createCache());
  const wire = hole instanceof Hole ? unroll(info, hole) : hole;
  if (wire !== info.wire) {
    info.wire = wire;
    where.replaceChildren(wire.valueOf());
  }
  return where;
};
var html = tag("html");
var svg = tag("svg");
/*! (c) Andrea Giammarchi - ISC */
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
function buildRequestUrlForData(url, data2) {
  Object.entries(data2.filters).forEach(([filterKey, filterValue]) => {
    if (typeof filterValue === "string") {
      url.searchParams.append(filterKey, filterValue);
    }
  });
  url.searchParams.append("currentPage", data2.currentPage);
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
  set data(data2) {
    __privateSet(this, _data, { ...__privateGet(this, _data), ...data2 });
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
        filters: {
          ...this.data.filters,
          locationUid: currentTarget.value
        }
      };
      this.fetchData();
    });
    const storedValue = retrieveValueFromLocalStorage("jobsFilterLocationUid");
    if (storedValue && selectElement) {
      const isValidOption = selectElement.querySelector(`option[value="${storedValue}"]`);
      if (!isValidOption)
        return;
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
        filters: {
          ...this.data.filters,
          categoryUid: currentTarget.value
        }
      };
      this.fetchData();
    });
    const storedValue = retrieveValueFromLocalStorage("jobsFilterCategoryUid");
    if (storedValue && selectElement) {
      const isValidOption = selectElement.querySelector(`option[value=${storedValue}]`);
      if (!isValidOption)
        return;
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
    const { data: data2 } = this;
    if (data2.isFetching) {
      render(this.mountElement, html`<div class="bw-jobs-list">
          <div class="bw-jobs-list__loader">${Spinner()}</div>
        </div>`);
      return;
    }
    if (!data2.jobPositions.length) {
      const isFiltered = !!(data2.filters.locationUid || data2.filters.categoryUid);
      render(this.mountElement, html`<div class="bw-jobs-empty bw-jobs-body">
          ${this.translations[isFiltered ? "nothingFound" : "nothingPosted"]}
        </div>`);
      return;
    }
    render(this.mountElement, html`<div class="bw-jobs-list">
        ${data2.jobPositions.map((jobPosition) => JobPosition(jobPosition, `${this.detailPageUrl}/${jobPosition.slug}`.replaceAll("//", "/")))}
        ${Pagination(data2.pages, data2.currentPage, (pageNumber) => {
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
