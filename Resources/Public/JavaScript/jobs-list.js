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
class MapSet extends Map {
  set(key, value) {
    super.set(key, value);
    return value;
  }
}
class WeakMapSet extends WeakMap {
  set(key, value) {
    super.set(key, value);
    return value;
  }
}
/*! (c) Andrea Giammarchi - ISC */
const empty = /^(?:area|base|br|col|embed|hr|img|input|keygen|link|menuitem|meta|param|source|track|wbr)$/i;
const elements = /<([a-z]+[a-z0-9:._-]*)([^>]*?)(\/?)>/g;
const attributes = /([^\s\\>"'=]+)\s*=\s*(['"]?)\x01/g;
const holes = /[\x01\x02]/g;
const instrument = (template, prefix2, svg2) => {
  let i = 0;
  return template.join("").trim().replace(
    elements,
    (_, name, attrs, selfClosing) => {
      let ml = name + attrs.replace(attributes, "=$2$1").trimEnd();
      if (selfClosing.length)
        ml += svg2 || empty.test(name) ? " /" : "></" + name;
      return "<" + ml + ">";
    }
  ).replace(
    holes,
    (hole) => hole === "" ? "<!--" + prefix2 + i++ + "-->" : prefix2 + i++
  );
};
const ELEMENT_NODE = 1;
const nodeType = 111;
const remove = ({ firstChild, lastChild }) => {
  const range = document.createRange();
  range.setStartAfter(firstChild);
  range.setEndAfter(lastChild);
  range.deleteContents();
  return firstChild;
};
const diffable = (node, operation) => node.nodeType === nodeType ? 1 / operation < 0 ? operation ? remove(node) : node.lastChild : operation ? node.valueOf() : node.firstChild : node;
const persistent = (fragment) => {
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
const { isArray: isArray$1 } = Array;
const aria = (node) => (values) => {
  for (const key in values) {
    const name = key === "role" ? key : `aria-${key}`;
    const value = values[key];
    if (value == null)
      node.removeAttribute(name);
    else
      node.setAttribute(name, value);
  }
};
const getValue = (value) => value == null ? value : value.valueOf();
const attribute = (node, name) => {
  let oldValue, orphan = true;
  const attributeNode = document.createAttributeNS(null, name);
  return (newValue) => {
    const value = getValue(newValue);
    if (oldValue !== value) {
      if ((oldValue = value) == null) {
        if (!orphan) {
          node.removeAttributeNode(attributeNode);
          orphan = true;
        }
      } else {
        attributeNode.value = value;
        if (orphan) {
          node.setAttributeNodeNS(attributeNode);
          orphan = false;
        }
      }
    }
  };
};
const boolean = (node, key, oldValue) => (newValue) => {
  const value = !!getValue(newValue);
  if (oldValue !== value) {
    if (oldValue = value)
      node.setAttribute(key, "");
    else
      node.removeAttribute(key);
  }
};
const data = ({ dataset }) => (values) => {
  for (const key in values) {
    const value = values[key];
    if (value == null)
      delete dataset[key];
    else
      dataset[key] = value;
  }
};
const event = (node, name) => {
  let oldValue, lower, type = name.slice(2);
  if (!(name in node) && (lower = name.toLowerCase()) in node)
    type = lower.slice(2);
  return (newValue) => {
    const info = isArray$1(newValue) ? newValue : [newValue, false];
    if (oldValue !== info[0]) {
      if (oldValue)
        node.removeEventListener(type, oldValue, info[1]);
      if (oldValue = info[0])
        node.addEventListener(type, oldValue, info[1]);
    }
  };
};
const ref = (node) => {
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
const setter = (node, key) => key === "dataset" ? data(node) : (value) => {
  node[key] = value;
};
const text = (node) => {
  let oldValue;
  return (newValue) => {
    const value = getValue(newValue);
    if (oldValue != value) {
      oldValue = value;
      node.textContent = value == null ? "" : value;
    }
  };
};
const udomdiff = (parentNode, a, b, get, before) => {
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
      parentNode.insertBefore(
        get(b[bStart++], 1),
        get(a[aStart++], -1).nextSibling
      );
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
            parentNode.replaceChild(
              get(b[bStart++], 1),
              get(a[aStart++], -1)
            );
          }
        } else
          aStart++;
      } else
        parentNode.removeChild(get(a[aStart++], -1));
    }
  }
  return b;
};
const { isArray, prototype } = Array;
const { indexOf } = prototype;
const {
  createDocumentFragment,
  createElement,
  createElementNS,
  createTextNode,
  createTreeWalker,
  importNode
} = new Proxy({}, {
  get: (_, method) => document[method].bind(document)
});
const createHTML = (html2) => {
  const template = createElement("template");
  template.innerHTML = html2;
  return template.content;
};
let xml;
const createSVG = (svg2) => {
  if (!xml)
    xml = createElementNS("http://www.w3.org/2000/svg", "svg");
  xml.innerHTML = svg2;
  const content = createDocumentFragment();
  content.append(...xml.childNodes);
  return content;
};
const createContent = (text2, svg2) => svg2 ? createSVG(text2) : createHTML(text2);
const reducePath = ({ childNodes }, i) => childNodes[i];
const diff = (comment, oldNodes, newNodes) => udomdiff(
  comment.parentNode,
  // TODO: there is a possible edge case where a node has been
  //       removed manually, or it was a keyed one, attached
  //       to a shared reference between renders.
  //       In this case udomdiff might fail at removing such node
  //       as its parent won't be the expected one.
  //       The best way to avoid this issue is to filter oldNodes
  //       in search of those not live, or not in the current parent
  //       anymore, but this would require both a change to uwire,
  //       exposing a parentNode from the firstChild, as example,
  //       but also a filter per each diff that should exclude nodes
  //       that are not in there, penalizing performance quite a lot.
  //       As this has been also a potential issue with domdiff,
  //       and both lighterhtml and hyperHTML might fail with this
  //       very specific edge case, I might as well document this possible
  //       "diffing shenanigan" and call it a day.
  oldNodes,
  newNodes,
  diffable,
  comment
);
const handleAnything = (comment) => {
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
        if (isArray(newValue)) {
          oldValue = newValue;
          if (newValue.length === 0)
            nodes = diff(comment, nodes, []);
          else if (typeof newValue[0] === "object")
            nodes = diff(comment, nodes, newValue);
          else
            anyContent(String(newValue));
          break;
        }
        if (oldValue !== newValue) {
          if ("ELEMENT_NODE" in newValue) {
            oldValue = newValue;
            nodes = diff(
              comment,
              nodes,
              newValue.nodeType === 11 ? [...newValue.childNodes] : [newValue]
            );
          } else {
            const value = newValue.valueOf();
            if (value !== newValue)
              anyContent(value);
          }
        }
        break;
      case "function":
        anyContent(newValue(comment));
        break;
    }
  };
  return anyContent;
};
const handleAttribute = (node, name) => {
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
  return attribute(
    node,
    name
    /*, svg*/
  );
};
function handlers(options) {
  const { type, path } = options;
  const node = path.reduceRight(reducePath, this);
  return type === "node" ? handleAnything(node) : type === "attr" ? handleAttribute(
    node,
    options.name
    /*, options.svg*/
  ) : text(node);
}
const createPath = (node) => {
  const path = [];
  let { parentNode } = node;
  while (parentNode) {
    path.push(indexOf.call(parentNode.childNodes, node));
    node = parentNode;
    ({ parentNode } = node);
  }
  return path;
};
const prefix = "isµ";
const cache$1 = new WeakMapSet();
const textOnly = /^(?:textarea|script|style|title|plaintext|xmp)$/;
const createCache = () => ({
  stack: [],
  // each template gets a stack for each interpolation "hole"
  entry: null,
  // each entry contains details, such as:
  //  * the template that is representing
  //  * the type of node it represents (html or svg)
  //  * the content fragment with all nodes
  //  * the list of updates per each node (template holes)
  //  * the "wired" node or fragment that will get updates
  // if the template or type are different from the previous one
  // the entry gets re-created each time
  wire: null
  // each rendered node represent some wired content and
  // this reference to the latest one. If different, the node
  // will be cleaned up and the new "wire" will be appended
});
const createEntry = (type, template) => {
  const { content, updates } = mapUpdates(type, template);
  return { type, template, content, updates, wire: null };
};
const mapTemplate = (type, template) => {
  const svg2 = type === "svg";
  const text2 = instrument(template, prefix, svg2);
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
const mapUpdates = (type, template) => {
  const { content, nodes } = cache$1.get(template) || cache$1.set(template, mapTemplate(type, template));
  const fragment = importNode(content, true);
  const updates = nodes.map(handlers, fragment);
  return { content: fragment, updates };
};
const unroll = (info, { type, template, values }) => {
  const length = unrollValues(info, values);
  let { entry } = info;
  if (!entry || (entry.template !== template || entry.type !== type))
    info.entry = entry = createEntry(type, template);
  const { content, updates, wire } = entry;
  for (let i = 0; i < length; i++)
    updates[i](values[i]);
  return wire || (entry.wire = persistent(content));
};
const unrollValues = ({ stack }, values) => {
  const { length } = values;
  for (let i = 0; i < length; i++) {
    const hole = values[i];
    if (hole instanceof Hole)
      values[i] = unroll(
        stack[i] || (stack[i] = createCache()),
        hole
      );
    else if (isArray(hole))
      unrollValues(stack[i] || (stack[i] = createCache()), hole);
    else
      stack[i] = null;
  }
  if (length < stack.length)
    stack.splice(length);
  return length;
};
class Hole {
  constructor(type, template, values) {
    this.type = type;
    this.template = template;
    this.values = values;
  }
}
const tag = (type) => {
  const keyed = new WeakMapSet();
  const fixed = (cache2) => (template, ...values) => unroll(
    cache2,
    { type, template, values }
  );
  return Object.assign(
    // non keyed operations are recognized as instance of Hole
    // during the "unroll", recursively resolved and updated
    (template, ...values) => new Hole(type, template, values),
    {
      // keyed operations need a reference object, usually the parent node
      // which is showing keyed results, and optionally a unique id per each
      // related node, handy with JSON results and mutable list of objects
      // that usually carry a unique identifier
      for(ref2, id) {
        const memo = keyed.get(ref2) || keyed.set(ref2, new MapSet());
        return memo.get(id) || memo.set(id, fixed(createCache()));
      },
      // it is possible to create one-off content out of the box via node tag
      // this might return the single created node, or a fragment with all
      // nodes present at the root level and, of course, their child nodes
      node: (template, ...values) => unroll(createCache(), new Hole(type, template, values)).valueOf()
    }
  );
};
const cache = new WeakMapSet();
const render = (where, what) => {
  const hole = typeof what === "function" ? what() : what;
  const info = cache.get(where) || cache.set(where, createCache());
  const wire = hole instanceof Hole ? unroll(info, hole) : hole;
  if (wire !== info.wire) {
    info.wire = wire;
    where.replaceChildren(wire.valueOf());
  }
  return where;
};
const html = tag("html");
const svg = tag("svg");
function stripLeadingSlash(string) {
  return string.replace(/^\//, "");
}
function stripTrailingSlash(string) {
  return string.replace(/\/$/, "");
}
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
  /**
   * Constructor
   *
   * @param {string} mountElementSelector
   * @param {string} locationFilterSelector
   * @param {string} categoryFilterSelector
   *
   * @memberof JobsList
   */
  constructor(mountElementSelector, locationFilterSelector, categoryFilterSelector) {
    /**
     * @type {?string}
     *
     * @private
     * @memberof JobsList
     */
    __privateAdd(this, _mountElementSelector, null);
    /**
     * @type {?string}
     *
     * @private
     * @memberof JobsList
     */
    __privateAdd(this, _locationFilterSelector, null);
    /**
     * @type {?string}
     *
     * @private
     * @memberof JobsList
     */
    __privateAdd(this, _categoryFilterSelector, null);
    /**
     * @type {Data}
     *
     * @private
     * @memberof JobsList
     */
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
  /**
   * @type {Data}
   *
   * @memberof JobsList
   */
  get data() {
    return __privateGet(this, _data);
  }
  /**
   * @property {Partial<Data>} data
   *
   * @return {void}
   *
   * @memberof JobsList
   */
  set data(data2) {
    __privateSet(this, _data, { ...__privateGet(this, _data), ...data2 });
    this.render();
  }
  /**
   * @type {HTMLElement}
   *
   * @readonly
   * @memberof JobsList
   */
  get mountElement() {
    return getElementOrFail(__privateGet(this, _mountElementSelector));
  }
  /**
   * @type {Record<string, string>}
   *
   * @readonly
   * @memberof JobsList
   */
  get translations() {
    const { translations } = this.mountElement.dataset;
    return JSON.parse(translations || "{}");
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
        `Missing "data-endpoint" attribute on the "${__privateGet(this, _mountElementSelector)}" mount element`
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
        `Missing "data-detail-page-path" attribute on the "${__privateGet(this, _mountElementSelector)}" mount element`
      );
    }
    return new URL(stripTrailingSlash(detailPagePath), window.location.origin);
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
      const isValidOption = selectElement.querySelector(
        `option[value="${storedValue}"]`
      );
      if (!isValidOption)
        return;
      selectElement.value = storedValue;
      selectElement.dispatchEvent(new Event("change"));
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
      const isValidOption = selectElement.querySelector(
        `option[value=${storedValue}]`
      );
      if (!isValidOption)
        return;
      selectElement.value = storedValue;
      selectElement.dispatchEvent(new Event("change"));
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
      buildRequestUrlForData(this.endpointUrl, this.data)
    );
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
  /**
   * The render function.
   * Automatically called on changes to `data`.
   *
   * @return {Promise<void>}
   *
   * @memberof JobsList
   */
  async render() {
    const { data: data2 } = this;
    if (data2.isFetching) {
      render(
        this.mountElement,
        html`<div class="bw-jobs-list">
          <div class="bw-jobs-list__loader">${Spinner()}</div>
        </div>`
      );
      return;
    }
    if (!data2.jobPositions.length) {
      const isFiltered = !!(data2.filters.locationUid || data2.filters.categoryUid);
      render(
        this.mountElement,
        html`<div class="bw-jobs-empty bw-jobs-body">
          ${this.translations[isFiltered ? "nothingFound" : "nothingPosted"]}
        </div>`
      );
      return;
    }
    render(
      this.mountElement,
      html`<div class="bw-jobs-list">
        ${data2.jobPositions.map((jobPosition) => {
        const url = `${this.detailPageUrl}/${stripLeadingSlash(
          jobPosition.slug
        )}`;
        return JobPosition(jobPosition, url);
      })}
        ${Pagination(data2.pages, data2.currentPage, (pageNumber) => {
        this.data = { currentPage: pageNumber };
        this.fetchData();
      })}
      </div>`
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
_mountElementSelector = new WeakMap();
_locationFilterSelector = new WeakMap();
_categoryFilterSelector = new WeakMap();
_data = new WeakMap();
const jobsList = new JobsList(
  "#bw-jobs-list",
  "#bw-jobs-location-filter",
  "#bw-jobs-category-filter"
);
jobsList.mount();
