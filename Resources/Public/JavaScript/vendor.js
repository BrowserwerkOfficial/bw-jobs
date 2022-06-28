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
var instrument = (template, prefix2, svg2) => {
  let i = 0;
  return template.join("").trim().replace(elements, (_, name, attrs, selfClosing) => {
    let ml = name + attrs.replace(attributes, "=$2$1").trimEnd();
    if (selfClosing.length)
      ml += svg2 || empty.test(name) ? " /" : "></" + name;
    return "<" + ml + ">";
  }).replace(holes, (hole) => hole === "" ? "<!--" + prefix2 + i++ + "-->" : prefix2 + i++);
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
const attribute = (node, name) => {
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
const boolean = (node, key, oldValue) => (newValue) => {
  if (oldValue !== !!newValue) {
    if (oldValue = !!newValue)
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
    if (oldValue != newValue) {
      oldValue = newValue;
      node.textContent = newValue == null ? "" : newValue;
    }
  };
};
var udomdiff = (parentNode, a, b, get, before) => {
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
const { isArray, prototype } = Array;
const { indexOf } = prototype;
const {
  createDocumentFragment,
  createElement,
  createElementNS,
  createTextNode,
  createTreeWalker,
  importNode
} = new Proxy(document, {
  get: (target, method) => target[method].bind(target)
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
const diff = (comment, oldNodes, newNodes) => udomdiff(comment.parentNode, oldNodes, newNodes, diffable, comment);
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
  return attribute(node, name);
};
function handlers(options) {
  const { type, path } = options;
  const node = path.reduceRight(reducePath, this);
  return type === "node" ? handleAnything(node) : type === "attr" ? handleAttribute(node, options.name) : text(node);
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
const prefix = "is\xB5";
const cache$1 = new WeakMapSet();
const textOnly = /^(?:textarea|script|style|title|plaintext|xmp)$/;
const createCache = () => ({
  stack: [],
  entry: null,
  wire: null
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
      values[i] = unroll(stack[i] || (stack[i] = createCache()), hole);
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
  const fixed = (cache2) => (template, ...values) => unroll(cache2, { type, template, values });
  return Object.assign((template, ...values) => new Hole(type, template, values), {
    for(ref2, id) {
      const memo = keyed.get(ref2) || keyed.set(ref2, new MapSet());
      return memo.get(id) || memo.set(id, fixed(createCache()));
    },
    node: (template, ...values) => unroll(createCache(), new Hole(type, template, values)).valueOf()
  });
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
export { html as h, render as r, svg as s };
