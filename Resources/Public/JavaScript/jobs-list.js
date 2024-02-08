var Z=(e,t,n)=>{if(!t.has(e))throw TypeError("Cannot "+n)};var f=(e,t,n)=>(Z(e,t,"read from private field"),n?n.call(e):t.get(e)),p=(e,t,n)=>{if(t.has(e))throw TypeError("Cannot add the same private member more than once");t instanceof WeakSet?t.add(e):t.set(e,n)},$=(e,t,n,s)=>(Z(e,t,"write to private field"),s?s.call(e,n):t.set(e,n),n);const ht=(e,t,n,s,r)=>{const o=n.length;let c=t.length,i=o,l=0,d=0,u=null;for(;l<c||d<i;)if(c===l){const a=i<o?d?s(n[d-1],-0).nextSibling:s(n[i-d],0):r;for(;d<i;)e.insertBefore(s(n[d++],1),a)}else if(i===d)for(;l<c;)(!u||!u.has(t[l]))&&e.removeChild(s(t[l],-1)),l++;else if(t[l]===n[d])l++,d++;else if(t[c-1]===n[i-1])c--,i--;else if(t[l]===n[i-1]&&n[d]===t[c-1]){const a=s(t[--c],-1).nextSibling;e.insertBefore(s(n[d++],1),s(t[l++],-1).nextSibling),e.insertBefore(s(n[--i],1),a),t[c]=n[i]}else{if(!u){u=new Map;let a=d;for(;a<i;)u.set(n[a],a++)}if(u.has(t[l])){const a=u.get(t[l]);if(d<a&&a<i){let h=l,g=1;for(;++h<c&&h<i&&u.get(t[h])===a+g;)g++;if(g>a-d){const j=s(t[l],0);for(;d<a;)e.insertBefore(s(n[d++],1),j)}else e.replaceChild(s(n[d++],1),s(t[l++],-1))}else l++}else e.removeChild(s(t[l++],-1))}return n},{isArray:et}=Array,{getPrototypeOf:ft,getOwnPropertyDescriptor:gt}=Object,bt="http://www.w3.org/2000/svg",w=[],nt=()=>document.createRange(),z=(e,t,n)=>(e.set(t,n),n),pt=(e,t)=>{let n;do n=gt(e,t);while(!n&&(e=ft(e)));return n},mt=1,wt=8,$t=11;/*! (c) Andrea Giammarchi - ISC */const{setPrototypeOf:Et}=Object,jt=e=>{function t(n){return Et(n,new.target.prototype)}return t.prototype=e.prototype,t};let v;const st=(e,t,n)=>(v||(v=nt()),n?v.setStartAfter(e):v.setStartBefore(e),v.setEndAfter(t),v.deleteContents(),e),R=({firstChild:e,lastChild:t},n)=>st(e,t,n);let it=!1;const D=(e,t)=>it&&e.nodeType===$t?1/t<0?t?R(e,!0):e.lastChild:t?e.valueOf():e.firstChild:e,X=e=>document.createComment(e);var _,S,m;class vt extends jt(DocumentFragment){constructor(n){super(n);p(this,_,X("<>"));p(this,S,X("</>"));p(this,m,w);this.replaceChildren(f(this,_),...n.childNodes,f(this,S)),it=!0}get firstChild(){return f(this,_)}get lastChild(){return f(this,S)}get parentNode(){return f(this,_).parentNode}remove(){R(this,!1)}replaceWith(n){R(this,!0).replaceWith(n)}valueOf(){let{firstChild:n,lastChild:s,parentNode:r}=this;if(r===this)f(this,m)===w&&$(this,m,[...this.childNodes]);else{if(r)for($(this,m,[n]);n!==s;)f(this,m).push(n=n.nextSibling);this.replaceChildren(...f(this,m))}return this}}_=new WeakMap,S=new WeakMap,m=new WeakMap;const rt=(e,t,n)=>e.setAttribute(t,n),P=(e,t)=>e.removeAttribute(t),_t=(e,t)=>{for(const n in t){const s=t[n],r=n==="role"?n:`aria-${n}`;s==null?P(e,r):rt(e,r,s)}return t};let F;const yt=(e,t,n)=>{n=n.slice(1),F||(F=new WeakMap);const s=F.get(e)||z(F,e,{});let r=s[n];return r&&r[0]&&e.removeEventListener(n,...r),r=et(t)?t:[t,!1],s[n]=r,r[0]&&e.addEventListener(n,...r),t},M=(e,t)=>{const{t:n,n:s}=e;let r=!1;switch(typeof t){case"object":if(t!==null){(s||n).replaceWith(e.n=t.valueOf());break}case"undefined":r=!0;default:n.data=r?"":t,s&&(e.n=null,s.replaceWith(n));break}return t},kt=(e,t)=>G(e,t,t==null?"class":"className"),Ct=(e,t)=>{const{dataset:n}=e;for(const s in t)t[s]==null?delete n[s]:n[s]=t[s];return t},U=(e,t,n)=>e[n]=t,Mt=(e,t,n)=>U(e,t,n.slice(1)),G=(e,t,n)=>t==null?(P(e,n),t):U(e,t,n),ot=(e,t)=>(typeof t=="function"?t(e):t.current=e,t),A=(e,t,n)=>(t==null?P(e,n):rt(e,n,t),t),St=(e,t)=>t==null?G(e,t,"style"):U(e.style,t,"cssText"),xt=(e,t,n)=>(e.toggleAttribute(n.slice(1),t),t),L=(e,t,n)=>{const{length:s}=t;if(e.data=`[${s}]`,s)return ht(e.parentNode,n,t,D,e);switch(n.length){case 1:n[0].remove();case 0:break;default:st(D(n[0],0),D(n.at(-1),-0),!1);break}return w},Nt=new Map([["aria",_t],["class",kt],["data",Ct],["ref",ot],["style",St]]),Ot=(e,t,n)=>{var s;switch(t[0]){case".":return Mt;case"?":return xt;case"@":return yt;default:return n||"ownerSVGElement"in e?t==="ref"?ot:A:Nt.get(t)||(t in e?t.startsWith("on")?U:(s=pt(e,t))!=null&&s.set?G:A:A)}},Ft=(e,t)=>(e.textContent=t??"",t),C=(e,t,n)=>({a:e,b:t,c:n}),Tt=(e,t)=>({b:e,c:t}),Lt=(e,t,n,s)=>({v:w,u:e,t,n,c:s}),O=()=>C(null,null,w),Pt=(e,t)=>t.reduceRight(Ut,e),Ut=(e,t)=>e.childNodes[t],lt=e=>(t,n)=>{const{a:s,b:r,c:o}=e(t,n),c=document.importNode(s,!0);let i=w;if(r!==w){i=[];for(let l,d,u=0;u<r.length;u++){const{a,b:h,c:g}=r[u],j=a===d?l:l=Pt(c,d=a);i[u]=Lt(h,j,g,h===L?[]:h===M?O():null)}}return Tt(o?c.firstChild:new vt(c),i)},Dt=/^(?:plaintext|script|style|textarea|title|xmp)$/i,At=/^(?:area|base|br|col|embed|hr|img|input|keygen|link|menuitem|meta|param|source|track|wbr)$/i;/*! (c) Andrea Giammarchi - ISC */const Vt=/<([a-zA-Z0-9]+[a-zA-Z0-9:._-]*)([^>]*?)(\/?)>/g,Bt=/([^\s\\>"'=]+)\s*=\s*(['"]?)\x01/g,Wt=/[\x01\x02]/g,It=(e,t,n)=>{let s=0;return e.join("").trim().replace(Vt,(r,o,c,i)=>`<${o}${c.replace(Bt,"=$2$1").trimEnd()}${i?n||At.test(o)?" /":`></${o}`:""}>`).replace(Wt,r=>r===""?`<!--${t+s++}-->`:t+s++)};let T=document.createElement("template"),V,B;const qt=(e,t)=>{if(t)return V||(V=document.createElementNS(bt,"svg"),B=nt(),B.selectNodeContents(V)),B.createContextualFragment(e);T.innerHTML=e;const{content:n}=T;return T=T.cloneNode(!1),n},W=e=>{const t=[];let n;for(;n=e.parentNode;)t.push(t.indexOf.call(n.childNodes,e)),e=n;return t},K=()=>document.createTextNode(""),Rt=(e,t,n)=>{const s=qt(It(e,k,n),n),{length:r}=e;let o=w;if(r>1){const l=[],d=document.createTreeWalker(s,129);let u=0,a=`${k}${u++}`;for(o=[];u<r;){const h=d.nextNode();if(h.nodeType===wt){if(h.data===a){const g=et(t[u-1])?L:M;g===M&&l.push(h),o.push(C(W(h),g,null)),a=`${k}${u++}`}}else{let g;for(;h.hasAttribute(a);){g||(g=W(h));const j=h.getAttribute(a);o.push(C(g,Ot(h,j,n),j)),P(h,a),a=`${k}${u++}`}!n&&Dt.test(h.localName)&&h.textContent.trim()===`<!--${a}-->`&&(o.push(C(g||W(h),Ft,null)),a=`${k}${u++}`)}}for(u=0;u<l.length;u++)l[u].replaceWith(K())}const{childNodes:c}=s;let{length:i}=c;return i<1?(i=1,s.appendChild(K())):i===1&&r!==1&&c[0].nodeType!==mt&&(i=0),z(ct,e,C(s,o,i===1))},ct=new WeakMap,k="isµ",at=e=>(t,n)=>ct.get(t)||Rt(t,n,e),zt=lt(at(!1)),Gt=lt(at(!0)),H=(e,{s:t,t:n,v:s})=>{if(e.a!==n){const{b:r,c:o}=(t?Gt:zt)(n,s);e.a=n,e.b=r,e.c=o}for(let{c:r}=e,o=0;o<r.length;o++){const c=s[o],i=r[o];switch(i.u){case L:i.v=L(i.t,Ht(i.c,c),i.v);break;case M:const l=c instanceof J?H(i.c||(i.c=O()),c):(i.c=null,c);l!==i.v&&(i.v=M(i,l));break;default:c!==i.v&&(i.v=i.u(i.t,c,i.n,i.v));break}}return e.b},Ht=(e,t)=>{let n=0,{length:s}=t;for(s<e.length&&e.splice(s);n<s;n++){const r=t[n];r instanceof J?t[n]=H(e[n]||(e[n]=O()),r):e[n]=null}return t};class J{constructor(t,n,s){this.s=t,this.t=n,this.v=s}toDOM(t=O()){return H(t,this)}}const Q=new WeakMap,I=(e,t)=>{const n=Q.get(e)||z(Q,e,O()),{b:s}=n;return s!==(typeof t=="function"?t():t).toDOM(n)&&e.replaceChildren(n.b.valueOf()),e};/*! (c) Andrea Giammarchi - MIT */const ut=e=>(t,...n)=>new J(e,t,n),b=ut(!1),dt=ut(!0);function Jt(e){return e.replace(/^\//,"")}function Zt(e){return e.replace(/\/$/,"")}function q(e){return e.filter(Boolean).join(" ")}function Xt(e){if(!e)throw new Error("Missing selector");const t=document.querySelector(e);if(!t)throw new Error(`Missing element "${e}"`);return t}function Kt(e,t){return Object.entries(t.filters).forEach(([n,s])=>{typeof s=="string"&&e.searchParams.append(n,s)}),e.searchParams.append("currentPage",`${t.currentPage}`),e}function Y(e,t){t?localStorage.setItem(e,t):localStorage.removeItem(e)}function tt(e){return localStorage.getItem(e)}function Qt(){return dt`
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
  `}function Yt(){return dt`
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
  `}function te(){return b`
    <div class="bw-jobs-spinner">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  `}function ee(e,t,n){return e.length<2?b``:b`
    <ul class="bw-jobs-paginator">
      <li
        class=${q(["bw-jobs-paginator__item bw-jobs-paginator__item--prev",t===1&&"bw-jobs-paginator__item--disabled"])}
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
      ${e.map(s=>b`<li
          class=${q(["bw-jobs-paginator__item",s===t&&"bw-jobs-paginator__item--current"])}
        >
          <button
            class="bw-jobs-paginator__item-button"
            @click=${()=>n(s)}
          >
            ${s}
          </button>
        </li>`)}
      <li
        class=${q(["bw-jobs-paginator__item bw-jobs-paginator__item--next",t===e.length&&"bw-jobs-paginator__item--disabled"])}
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
  `}function ne(e){return e.length?b`<div class="bw-jobs-list-item__column">
    ${Qt()} ${e[0].title}
  </div>`:b``}function se(e){return e.length?b`<div
    class="bw-jobs-list-item__column bw-jobs-list-item__column--locations"
  >
    ${Yt()} ${e.map(t=>t.title).join(", ")}
  </div>`:b``}function ie({title:e,employmentTypes:t,locations:n},s){return b`
    <a class="bw-jobs-list-item" href="${s}" title="${e}">
      <div class="bw-jobs-list-item__inner">
        <div class="bw-jobs-list-item__column bw-jobs-list-item__column--title">
          ${e}
        </div>
        ${ne(t)} ${se(n)}
      </div>
    </a>
  `}var E,x,N,y;class re{constructor(t,n,s){p(this,E,void 0);p(this,x,void 0);p(this,N,void 0);p(this,y,{isFetching:!0,jobPositions:[],pages:[],currentPage:1,filters:{locationUid:null,categoryUid:null}});if(!t)throw new Error("Missing mountElementSelector");if(!n)throw new Error("Missing locationFilterSelector");if(!s)throw new Error("Missing categoryFilterSelector");$(this,E,t),$(this,x,n),$(this,N,s),this.initLocationFilter(),this.initCategoryFilter()}get data(){return f(this,y)}set data(t){$(this,y,{...f(this,y),...t}),this.render()}get mountElement(){return Xt(f(this,E))}get translations(){const{translations:t}=this.mountElement.dataset;return JSON.parse(t||"{}")}get endpointUrl(){const{endpoint:t}=this.mountElement.dataset;if(!t)throw new Error(`Missing "data-endpoint" attribute on the "${f(this,E)}" mount element`);return new URL(t,window.location.origin)}get detailPageUrl(){const{detailPagePath:t}=this.mountElement.dataset;if(!t)throw new Error(`Missing "data-detail-page-path" attribute on the "${f(this,E)}" mount element`);return new URL(Zt(t),window.location.origin)}initLocationFilter(){const t=document.querySelector(f(this,x));if(!t)return;t.addEventListener("change",r=>{const o=r.currentTarget;Y("jobsFilterLocationUid",o.value),this.data={...this.data,currentPage:1,filters:{...this.data.filters,locationUid:o.value?parseInt(o.value):null}},this.fetchData()});const n=tt("jobsFilterLocationUid");!n||!t.querySelector(`option[value="${n}"]`)||(t.value=n,t.dispatchEvent(new Event("change")))}initCategoryFilter(){const t=document.querySelector(f(this,N));if(!t)return;t.addEventListener("change",r=>{const o=r.currentTarget;Y("jobsFilterCategoryUid",o.value),this.data={...this.data,currentPage:1,filters:{...this.data.filters,categoryUid:o.value?parseInt(o.value):null}},this.fetchData()});const n=tt("jobsFilterCategoryUid");!n||!t.querySelector(`option[value=${n}]`)||(t.value=n,t.dispatchEvent(new Event("change")))}async fetchData(){this.data={...this.data,isFetching:!0};const t=await fetch(Kt(this.endpointUrl,this.data));if(!t.ok)throw new Error(t.statusText);const{jobPositions:n,pages:s}=await t.json();this.data={...this.data,isFetching:!1,jobPositions:n,pages:s}}async render(){const{data:t}=this;if(t.isFetching){I(this.mountElement,b`<div class="bw-jobs-list">
          <div class="bw-jobs-list__loader">${te()}</div>
        </div>`);return}if(!t.jobPositions.length){const n=!!(t.filters.locationUid||t.filters.categoryUid);I(this.mountElement,b`<div class="bw-jobs-empty bw-jobs-body">
          ${this.translations[n?"nothingFound":"nothingPosted"]}
        </div>`);return}I(this.mountElement,b`<div class="bw-jobs-list">
        ${t.jobPositions.map(n=>{const s=`${this.detailPageUrl}/${Jt(n.slug)}`;return ie(n,s)})}
        ${ee(t.pages,t.currentPage,n=>{this.data={...this.data,currentPage:n},this.fetchData()})}
      </div>`)}async mount(){this.fetchData()}}E=new WeakMap,x=new WeakMap,N=new WeakMap,y=new WeakMap;const oe=new re("#bw-jobs-list","#bw-jobs-location-filter","#bw-jobs-category-filter");oe.mount();
