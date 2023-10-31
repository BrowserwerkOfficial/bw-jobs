var O=(e,t,n)=>{if(!t.has(e))throw TypeError("Cannot "+n)};var f=(e,t,n)=>(O(e,t,"read from private field"),n?n.call(e):t.get(e)),g=(e,t,n)=>{if(t.has(e))throw TypeError("Cannot add the same private member more than once");t instanceof WeakSet?t.add(e):t.set(e,n)},m=(e,t,n,i)=>(O(e,t,"write to private field"),i?i.call(e,n):t.set(e,n),n);class J extends Map{set(t,n){return super.set(t,n),n}}class F extends WeakMap{set(t,n){return super.set(t,n),n}}/*! (c) Andrea Giammarchi - ISC */const W=/^(?:area|base|br|col|embed|hr|img|input|keygen|link|menuitem|meta|param|source|track|wbr)$/i,G=/<([a-z]+[a-z0-9:._-]*)([^>]*?)(\/?)>/g,K=/([^\s\\>"'=]+)\s*=\s*(['"]?)\x01/g,Q=/[\x01\x02]/g,X=(e,t,n)=>{let i=0;return e.join("").trim().replace(G,(s,o,l,u)=>{let c=o+l.replace(K,"=$2$1").trimEnd();return u.length&&(c+=n||W.test(o)?" /":"></"+o),"<"+c+">"}).replace(Q,s=>s===""?"<!--"+t+i+++"-->":t+i++)},Y=1,D=111,Z=({firstChild:e,lastChild:t})=>{const n=document.createRange();return n.setStartAfter(e),n.setEndAfter(t),n.deleteContents(),e},V=(e,t)=>e.nodeType===D?1/t<0?t?Z(e):e.lastChild:t?e.valueOf():e.firstChild:e,tt=e=>{const{firstChild:t,lastChild:n}=e;if(t===n)return n||e;const{childNodes:i}=e,s=[...i];return{ELEMENT_NODE:Y,nodeType:D,firstChild:t,lastChild:n,valueOf(){return i.length!==s.length&&e.append(...s),e}}},{isArray:et}=Array,nt=e=>t=>{for(const n in t){const i=n==="role"?n:`aria-${n}`,s=t[n];s==null?e.removeAttribute(i):e.setAttribute(i,s)}},A=e=>e==null?e:e.valueOf(),it=(e,t)=>{let n,i=!0;const s=document.createAttributeNS(null,t);return o=>{const l=A(o);n!==l&&((n=l)==null?i||(e.removeAttributeNode(s),i=!0):(s.value=l,i&&(e.setAttributeNodeNS(s),i=!1)))}},st=(e,t,n)=>i=>{const s=!!A(i);n!==s&&((n=s)?e.setAttribute(t,""):e.removeAttribute(t))},ot=({dataset:e})=>t=>{for(const n in t){const i=t[n];i==null?delete e[n]:e[n]=i}},U=(e,t)=>{let n,i,s=t.slice(2);return!(t in e)&&(i=t.toLowerCase())in e&&(s=i.slice(2)),o=>{const l=et(o)?o:[o,!1];n!==l[0]&&(n&&e.removeEventListener(s,n,l[1]),(n=l[0])&&e.addEventListener(s,n,l[1]))}},rt=e=>{let t;return n=>{t!==n&&(t=n,typeof n=="function"?n(e):n.current=e)}},lt=(e,t)=>t==="dataset"?ot(e):n=>{e[t]=n},ct=e=>{let t;return n=>{const i=A(n);t!=i&&(t=i,e.textContent=i??"")}},at=(e,t,n,i,s)=>{const o=n.length;let l=t.length,u=o,c=0,r=0,a=null;for(;c<l||r<u;)if(l===c){const d=u<o?r?i(n[r-1],-0).nextSibling:i(n[u-r],0):s;for(;r<u;)e.insertBefore(i(n[r++],1),d)}else if(u===r)for(;c<l;)(!a||!a.has(t[c]))&&e.removeChild(i(t[c],-1)),c++;else if(t[c]===n[r])c++,r++;else if(t[l-1]===n[u-1])l--,u--;else if(t[c]===n[u-1]&&n[r]===t[l-1]){const d=i(t[--l],-1).nextSibling;e.insertBefore(i(n[r++],1),i(t[c++],-1).nextSibling),e.insertBefore(i(n[--u],1),d),t[l]=n[u]}else{if(!a){a=new Map;let d=r;for(;d<u;)a.set(n[d],d++)}if(a.has(t[c])){const d=a.get(t[c]);if(r<d&&d<u){let k=c,S=1;for(;++k<l&&k<u&&a.get(t[k])===d+S;)S++;if(S>d-r){const H=i(t[c],0);for(;r<d;)e.insertBefore(i(n[r++],1),H)}else e.replaceChild(i(n[r++],1),i(t[c++],-1))}else c++}else e.removeChild(i(t[c++],-1))}return n},{isArray:q,prototype:ut}=Array,{indexOf:dt}=ut,{createDocumentFragment:ht,createElement:ft,createElementNS:bt,createTextNode:pt,createTreeWalker:gt,importNode:mt}=new Proxy({},{get:(e,t)=>document[t].bind(document)}),vt=e=>{const t=ft("template");return t.innerHTML=e,t.content};let $;const wt=e=>{$||($=bt("http://www.w3.org/2000/svg","svg")),$.innerHTML=e;const t=ht();return t.append(...$.childNodes),t},jt=(e,t)=>t?wt(e):vt(e),_t=({childNodes:e},t)=>e[t],v=(e,t,n)=>at(e.parentNode,t,n,V,e),yt=e=>{let t,n,i=[];const s=o=>{switch(typeof o){case"string":case"number":case"boolean":t!==o&&(t=o,n||(n=pt("")),n.data=o,i=v(e,i,[n]));break;case"object":case"undefined":if(o==null){t!=o&&(t=o,i=v(e,i,[]));break}if(q(o)){t=o,o.length===0?i=v(e,i,[]):typeof o[0]=="object"?i=v(e,i,o):s(String(o));break}if(t!==o)if("ELEMENT_NODE"in o)t=o,i=v(e,i,o.nodeType===11?[...o.childNodes]:[o]);else{const l=o.valueOf();l!==o&&s(l)}break;case"function":s(o(e));break}};return s},$t=(e,t)=>{switch(t[0]){case"?":return st(e,t.slice(1),!1);case".":return lt(e,t.slice(1));case"@":return U(e,"on"+t.slice(1));case"o":if(t[1]==="n")return U(e,t)}switch(t){case"ref":return rt(e);case"aria":return nt(e)}return it(e,t)};function Et(e){const{type:t,path:n}=e,i=n.reduceRight(_t,this);return t==="node"?yt(i):t==="attr"?$t(i,e.name):ct(i)}const C=e=>{const t=[];let{parentNode:n}=e;for(;n;)t.push(dt.call(n.childNodes,e)),e=n,{parentNode:n}=e;return t},w="isµ",P=new F,xt=/^(?:textarea|script|style|title|plaintext|xmp)$/,j=()=>({stack:[],entry:null,wire:null}),kt=(e,t)=>{const{content:n,updates:i}=Ct(e,t);return{type:e,template:t,content:n,updates:i,wire:null}},St=(e,t)=>{const n=e==="svg",i=X(t,w,n),s=jt(i,n),o=gt(s,129),l=[],u=t.length-1;let c=0,r=`${w}${c}`;for(;c<u;){const a=o.nextNode();if(!a)throw`bad template: ${i}`;if(a.nodeType===8)a.data===r&&(l.push({type:"node",path:C(a)}),r=`${w}${++c}`);else{for(;a.hasAttribute(r);)l.push({type:"attr",path:C(a),name:a.getAttribute(r)}),a.removeAttribute(r),r=`${w}${++c}`;xt.test(a.localName)&&a.textContent.trim()===`<!--${r}-->`&&(a.textContent="",l.push({type:"text",path:C(a)}),r=`${w}${++c}`)}}return{content:s,nodes:l}},Ct=(e,t)=>{const{content:n,nodes:i}=P.get(t)||P.set(t,St(e,t)),s=mt(n,!0),o=i.map(Et,s);return{content:s,updates:o}},E=(e,{type:t,template:n,values:i})=>{const s=z(e,i);let{entry:o}=e;(!o||o.template!==n||o.type!==t)&&(e.entry=o=kt(t,n));const{content:l,updates:u,wire:c}=o;for(let r=0;r<s;r++)u[r](i[r]);return c||(o.wire=tt(l))},z=({stack:e},t)=>{const{length:n}=t;for(let i=0;i<n;i++){const s=t[i];s instanceof x?t[i]=E(e[i]||(e[i]=j()),s):q(s)?z(e[i]||(e[i]=j()),s):e[i]=null}return n<e.length&&e.splice(n),n};class x{constructor(t,n,i){this.type=t,this.template=n,this.values=i}}const I=e=>{const t=new F,n=i=>(s,...o)=>E(i,{type:e,template:s,values:o});return Object.assign((i,...s)=>new x(e,i,s),{for(i,s){const o=t.get(i)||t.set(i,new J);return o.get(s)||o.set(s,n(j()))},node:(i,...s)=>E(j(),new x(e,i,s)).valueOf()})},N=new F,L=(e,t)=>{const n=typeof t=="function"?t():t,i=N.get(e)||N.set(e,j()),s=n instanceof x?E(i,n):n;return s!==i.wire&&(i.wire=s,e.replaceChildren(s.valueOf())),e},h=I("html"),R=I("svg");function Lt(e){return e.replace(/^\//,"")}function Mt(e){return e.replace(/\/$/,"")}function M(e){return e.filter(Boolean).join(" ")}function Ft(e){const t=document.querySelector(e);if(!t)throw new Error(`Missing element "${e}"`);return t}function At(e,t){return Object.entries(t.filters).forEach(([n,i])=>{typeof i=="string"&&e.searchParams.append(n,i)}),e.searchParams.append("currentPage",t.currentPage),e}function T(e,t){t?localStorage.setItem(e,t):localStorage.removeItem(e)}function B(e){return localStorage.getItem(e)}function Ot(){return R`
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
  `}function Ut(){return R`
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
  `}function Pt(){return h`
    <div class="bw-jobs-spinner">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  `}function Nt(e,t,n){return e.length<2?"":h`
    <ul class="bw-jobs-paginator">
      <li
        class=${M(["bw-jobs-paginator__item bw-jobs-paginator__item--prev",t===1&&"bw-jobs-paginator__item--disabled"])}
      >
        <button
          class="bw-jobs-paginator__item-button"
          @click=${()=>n(Math.max(t-1,1))}
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
      ${e.map(i=>h`<li
          class=${M(["bw-jobs-paginator__item",i===t&&"bw-jobs-paginator__item--current"])}
        >
          <button
            class="bw-jobs-paginator__item-button"
            @click=${()=>n(i)}
          >
            ${i}
          </button>
        </li>`)}
      <li
        class=${M(["bw-jobs-paginator__item bw-jobs-paginator__item--next",t===e.length&&"bw-jobs-paginator__item--disabled"])}
      >
        <button
          class="bw-jobs-paginator__item-button"
          @click=${()=>n(Math.min(t+1,e.length))}
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
  `}function Tt(e){return e.length?h`<div class="bw-jobs-list-item__column">
    ${Ot()} ${e[0].title}
  </div>`:""}function Bt(e){return e.length?h`<div
    class="bw-jobs-list-item__column bw-jobs-list-item__column--locations"
  >
    ${Ut()} ${e.map(t=>t.title).join(", ")}
  </div>`:""}function Dt({title:e,employmentTypes:t,locations:n},i){return h`
    <a class="bw-jobs-list-item" href="${i}" title="${e}">
      <div class="bw-jobs-list-item__inner">
        <div class="bw-jobs-list-item__column bw-jobs-list-item__column--title">
          ${e}
        </div>
        ${Tt(t)} ${Bt(n)}
      </div>
    </a>
  `}var b,_,y,p;class qt{constructor(t,n,i){g(this,b,null);g(this,_,null);g(this,y,null);g(this,p,{isFetching:!0,jobPositions:[],pages:[],currentPage:1,filters:{locationUid:null,categoryUid:null}});if(!t)throw new Error("Missing mountElementSelector");if(!n)throw new Error("Missing locationFilterSelector");if(!i)throw new Error("Missing categoryFilterSelector");m(this,b,t),m(this,_,n),m(this,y,i),this.initLocationFilter(),this.initCategoryFilter()}get data(){return f(this,p)}set data(t){m(this,p,{...f(this,p),...t}),this.render()}get mountElement(){return Ft(f(this,b))}get translations(){const{translations:t}=this.mountElement.dataset;return JSON.parse(t||"{}")}get endpointUrl(){const{endpoint:t}=this.mountElement.dataset;if(!t)throw new Error(`Missing "data-endpoint" attribute on the "${f(this,b)}" mount element`);return new URL(t,window.location.origin)}get detailPageUrl(){const{detailPagePath:t}=this.mountElement.dataset;if(!t)throw new Error(`Missing "data-detail-page-path" attribute on the "${f(this,b)}" mount element`);return new URL(Mt(t),window.location.origin)}initLocationFilter(){const t=document.querySelector(f(this,_));t==null||t.addEventListener("change",({currentTarget:i})=>{T("jobsFilterLocationUid",i.value),this.data={currentPage:1,filters:{...this.data.filters,locationUid:i.value}},this.fetchData()});const n=B("jobsFilterLocationUid");if(n&&t){if(!t.querySelector(`option[value="${n}"]`))return;t.value=n,t.dispatchEvent(new Event("change"))}}initCategoryFilter(){const t=document.querySelector(f(this,y));t==null||t.addEventListener("change",({currentTarget:i})=>{T("jobsFilterCategoryUid",i.value),this.data={currentPage:1,filters:{...this.data.filters,categoryUid:i.value}},this.fetchData()});const n=B("jobsFilterCategoryUid");if(n&&t){if(!t.querySelector(`option[value=${n}]`))return;t.value=n,t.dispatchEvent(new Event("change"))}}async fetchData(){this.data={isFetching:!0};const t=await fetch(At(this.endpointUrl,this.data));if(!t.ok)throw new Error(t.statusText);const{jobPositions:n,pages:i}=await t.json();this.data={isFetching:!1,jobPositions:n,pages:i}}async render(){const{data:t}=this;if(t.isFetching){L(this.mountElement,h`<div class="bw-jobs-list">
          <div class="bw-jobs-list__loader">${Pt()}</div>
        </div>`);return}if(!t.jobPositions.length){const n=!!(t.filters.locationUid||t.filters.categoryUid);L(this.mountElement,h`<div class="bw-jobs-empty bw-jobs-body">
          ${this.translations[n?"nothingFound":"nothingPosted"]}
        </div>`);return}L(this.mountElement,h`<div class="bw-jobs-list">
        ${t.jobPositions.map(n=>{const i=`${this.detailPageUrl}/${Lt(n.slug)}`;return Dt(n,i)})}
        ${Nt(t.pages,t.currentPage,n=>{this.data={currentPage:n},this.fetchData()})}
      </div>`)}async mount(){this.fetchData()}}b=new WeakMap,_=new WeakMap,y=new WeakMap,p=new WeakMap;const zt=new qt("#bw-jobs-list","#bw-jobs-location-filter","#bw-jobs-category-filter");zt.mount();
