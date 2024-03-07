var Z=(e,t,n)=>{if(!t.has(e))throw TypeError("Cannot "+n)};var f=(e,t,n)=>(Z(e,t,"read from private field"),n?n.call(e):t.get(e)),p=(e,t,n)=>{if(t.has(e))throw TypeError("Cannot add the same private member more than once");t instanceof WeakSet?t.add(e):t.set(e,n)},$=(e,t,n,s)=>(Z(e,t,"write to private field"),s?s.call(e,n):t.set(e,n),n);const ut=(e,t,n,s,r)=>{const d=n.length;let c=t.length,i=d,o=0,u=0,a=null;for(;o<c||u<i;)if(c===o){const l=i<d?u?s(n[u-1],-0).nextSibling:s(n[i-u],0):r;for(;u<i;)e.insertBefore(s(n[u++],1),l)}else if(i===u)for(;o<c;)(!a||!a.has(t[o]))&&e.removeChild(s(t[o],-1)),o++;else if(t[o]===n[u])o++,u++;else if(t[c-1]===n[i-1])c--,i--;else if(t[o]===n[i-1]&&n[u]===t[c-1]){const l=s(t[--c],-1).nextSibling;e.insertBefore(s(n[u++],1),s(t[o++],-1).nextSibling),e.insertBefore(s(n[--i],1),l),t[c]=n[i]}else{if(!a){a=new Map;let l=u;for(;l<i;)a.set(n[l],l++)}if(a.has(t[o])){const l=a.get(t[o]);if(u<l&&l<i){let h=o,b=1;for(;++h<c&&h<i&&a.get(t[h])===l+b;)b++;if(b>l-u){const j=s(t[o],0);for(;u<l;)e.insertBefore(s(n[u++],1),j)}else e.replaceChild(s(n[u++],1),s(t[o++],-1))}else o++}else e.removeChild(s(t[o++],-1))}return n},{isArray:Y}=Array,{getPrototypeOf:dt,getOwnPropertyDescriptor:ht}=Object,ft="http://www.w3.org/2000/svg",w=[],tt=()=>document.createRange(),G=(e,t,n)=>(e.set(t,n),n),bt=(e,t)=>{let n;do n=ht(e,t);while(!n&&(e=dt(e)));return n},gt=1,pt=8,mt=11;/*! (c) Andrea Giammarchi - ISC */const{setPrototypeOf:wt}=Object,$t=e=>{function t(n){return wt(n,new.target.prototype)}return t.prototype=e.prototype,t};let E;const et=(e,t,n)=>(E||(E=tt()),n?E.setStartAfter(e):E.setStartBefore(e),E.setEndAfter(t),E.deleteContents(),e),z=({firstChild:e,lastChild:t},n)=>et(e,t,n);let nt=!1;const A=(e,t)=>nt&&e.nodeType===mt?1/t<0?t?z(e,!0):e.lastChild:t?e.valueOf():e.firstChild:e,X=e=>document.createComment(e);var v,x,m;class _t extends $t(DocumentFragment){constructor(n){super(n);p(this,v,X("<>"));p(this,x,X("</>"));p(this,m,w);this.replaceChildren(f(this,v),...n.childNodes,f(this,x)),nt=!0}get firstChild(){return f(this,v)}get lastChild(){return f(this,x)}get parentNode(){return f(this,v).parentNode}remove(){z(this,!1)}replaceWith(n){z(this,!0).replaceWith(n)}valueOf(){let{firstChild:n,lastChild:s,parentNode:r}=this;if(r===this)f(this,m)===w&&$(this,m,[...this.childNodes]);else{if(r)for($(this,m,[n]);n!==s;)f(this,m).push(n=n.nextSibling);this.replaceChildren(...f(this,m))}return this}}v=new WeakMap,x=new WeakMap,m=new WeakMap;const st=(e,t,n)=>e.setAttribute(t,n),L=(e,t)=>e.removeAttribute(t),jt=(e,t)=>{for(const n in t){const s=t[n],r=n==="role"?n:`aria-${n}`;s==null?L(e,r):st(e,r,s)}return t};let O;const Et=(e,t,n)=>{n=n.slice(1),O||(O=new WeakMap);const s=O.get(e)||G(O,e,{});let r=s[n];return r&&r[0]&&e.removeEventListener(n,...r),r=Y(t)?t:[t,!1],s[n]=r,r[0]&&e.addEventListener(n,...r),t},M=(e,t)=>{const{t:n,n:s}=e;let r=!1;switch(typeof t){case"object":if(t!==null){(s||n).replaceWith(e.n=t.valueOf());break}case"undefined":r=!0;default:n.data=r?"":t,s&&(e.n=null,s.replaceWith(n));break}return t},vt=(e,t)=>V(e,t,t==null?"class":"className"),yt=(e,t)=>{const{dataset:n}=e;for(const s in t)t[s]==null?delete n[s]:n[s]=t[s];return t},D=(e,t,n)=>e[n]=t,kt=(e,t,n)=>D(e,t,n.slice(1)),V=(e,t,n)=>t==null?(L(e,n),t):D(e,t,n),it=(e,t)=>(typeof t=="function"?t(e):t.current=e,t),U=(e,t,n)=>(t==null?L(e,n):st(e,n,t),t),Ct=(e,t)=>t==null?V(e,t,"style"):D(e.style,t,"cssText"),Mt=(e,t,n)=>(e.toggleAttribute(n.slice(1),t),t),F=(e,t,n)=>{const{length:s}=t;if(e.data=`[${s}]`,s)return ut(e.parentNode,n,t,A,e);switch(n.length){case 1:n[0].remove();case 0:break;default:et(A(n[0],0),A(n.at(-1),-0),!1);break}return w},xt=new Map([["aria",jt],["class",vt],["data",yt],["ref",it],["style",Ct]]),Nt=(e,t,n)=>{var s;switch(t[0]){case".":return kt;case"?":return Mt;case"@":return Et;default:return n||"ownerSVGElement"in e?t==="ref"?it:U:xt.get(t)||(t in e?t.startsWith("on")?D:(s=bt(e,t))!=null&&s.set?V:U:U)}},St=(e,t)=>(e.textContent=t??"",t),C=(e,t,n)=>({a:e,b:t,c:n}),Tt=(e,t)=>({b:e,c:t}),Ot=(e,t,n,s)=>({v:w,u:e,t,n,c:s}),T=()=>C(null,null,w),Pt=(e,t)=>t.reduceRight(Ft,e),Ft=(e,t)=>e.childNodes[t],rt=e=>(t,n)=>{const{a:s,b:r,c:d}=e(t,n),c=document.importNode(s,!0);let i=w;if(r!==w){i=[];for(let o,u,a=0;a<r.length;a++){const{a:l,b:h,c:b}=r[a],j=l===u?o:o=Pt(c,u=l);i[a]=Ot(h,j,b,h===F?[]:h===M?T():null)}}return Tt(d?c.firstChild:new _t(c),i)},Lt=/^(?:plaintext|script|style|textarea|title|xmp)$/i,Dt=/^(?:area|base|br|col|embed|hr|img|input|keygen|link|menuitem|meta|param|source|track|wbr)$/i;/*! (c) Andrea Giammarchi - ISC */const At=/<([a-zA-Z0-9]+[a-zA-Z0-9:._-]*)([^>]*?)(\/?)>/g,Ut=/([^\s\\>"'=]+)\s*=\s*(['"]?)\x01/g,Bt=/[\x01\x02]/g,Wt=(e,t,n)=>{let s=0;return e.join("").trim().replace(At,(r,d,c,i)=>`<${d}${c.replace(Ut,"=$2$1").trimEnd()}${i?n||Dt.test(d)?" /":`></${d}`:""}>`).replace(Bt,r=>r===""?`<!--${t+s++}-->`:t+s++)};let P=document.createElement("template"),B,W;const Rt=(e,t)=>{if(t)return B||(B=document.createElementNS(ft,"svg"),W=tt(),W.selectNodeContents(B)),W.createContextualFragment(e);P.innerHTML=e;const{content:n}=P;return P=P.cloneNode(!1),n},R=e=>{const t=[];let n;for(;n=e.parentNode;)t.push(t.indexOf.call(n.childNodes,e)),e=n;return t},K=()=>document.createTextNode(""),It=(e,t,n)=>{const s=Rt(Wt(e,k,n),n),{length:r}=e;let d=w;if(r>1){const o=[],u=document.createTreeWalker(s,129);let a=0,l=`${k}${a++}`;for(d=[];a<r;){const h=u.nextNode();if(h.nodeType===pt){if(h.data===l){const b=Y(t[a-1])?F:M;b===M&&o.push(h),d.push(C(R(h),b,null)),l=`${k}${a++}`}}else{let b;for(;h.hasAttribute(l);){b||(b=R(h));const j=h.getAttribute(l);d.push(C(b,Nt(h,j,n),j)),L(h,l),l=`${k}${a++}`}!n&&Lt.test(h.localName)&&h.textContent.trim()===`<!--${l}-->`&&(d.push(C(b||R(h),St,null)),l=`${k}${a++}`)}}for(a=0;a<o.length;a++)o[a].replaceWith(K())}const{childNodes:c}=s;let{length:i}=c;return i<1?(i=1,s.appendChild(K())):i===1&&r!==1&&c[0].nodeType!==gt&&(i=0),G(ot,e,C(s,d,i===1))},ot=new WeakMap,k="isµ",ct=e=>(t,n)=>ot.get(t)||It(t,n,e),qt=rt(ct(!1)),zt=rt(ct(!0)),H=(e,{s:t,t:n,v:s})=>{if(e.a!==n){const{b:r,c:d}=(t?zt:qt)(n,s);e.a=n,e.b=r,e.c=d}for(let{c:r}=e,d=0;d<r.length;d++){const c=s[d],i=r[d];switch(i.u){case F:i.v=F(i.t,Gt(i.c,c),i.v);break;case M:const o=c instanceof J?H(i.c||(i.c=T()),c):(i.c=null,c);o!==i.v&&(i.v=M(i,o));break;default:c!==i.v&&(i.v=i.u(i.t,c,i.n,i.v));break}}return e.b},Gt=(e,t)=>{let n=0,{length:s}=t;for(s<e.length&&e.splice(s);n<s;n++){const r=t[n];r instanceof J?t[n]=H(e[n]||(e[n]=T()),r):e[n]=null}return t};class J{constructor(t,n,s){this.s=t,this.t=n,this.v=s}toDOM(t=T()){return H(t,this)}}const Q=new WeakMap,I=(e,t)=>{const n=Q.get(e)||G(Q,e,T()),{b:s}=n;return s!==(typeof t=="function"?t():t).toDOM(n)&&e.replaceChildren(n.b.valueOf()),e};/*! (c) Andrea Giammarchi - MIT */const lt=e=>(t,...n)=>new J(e,t,n),g=lt(!1),at=lt(!0);function Vt(e){return e.replace(/^\//,"")}function Ht(e){return e.replace(/\/$/,"")}function q(e){return e.filter(Boolean).join(" ")}function Jt(e){const t=document.querySelector(e);if(!t)throw new Error(`Missing element "${e}"`);return t}function Zt(e,t){return Object.entries(t.filters).forEach(([n,s])=>{typeof s=="number"&&e.searchParams.append(n,`${s}`)}),e.searchParams.append("currentPage",`${t.currentPage}`),e}function Xt(){return at`
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
  `}function Kt(){return at`
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
  `}function Qt(){return g`
    <div class="bw-jobs-spinner">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  `}function Yt(e,t,n){return e.length<2?g``:g`
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
      ${e.map(s=>g`<li
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
  `}function te(e){return e.length?g`<div class="bw-jobs-list-item__column">
    ${Xt()} ${e[0].title}
  </div>`:g``}function ee(e){return e.length?g`<div
    class="bw-jobs-list-item__column bw-jobs-list-item__column--locations"
  >
    ${Kt()} ${e.map(t=>t.title).join(", ")}
  </div>`:g``}function ne({title:e,employmentTypes:t,locations:n},s){return g`
    <a class="bw-jobs-list-item" href="${s}" title="${e}">
      <div class="bw-jobs-list-item__inner">
        <div class="bw-jobs-list-item__column bw-jobs-list-item__column--title">
          ${e}
        </div>
        ${te(t)} ${ee(n)}
      </div>
    </a>
  `}var _,N,S,y;class se{constructor(t,n,s){p(this,_,void 0);p(this,N,void 0);p(this,S,void 0);p(this,y,{isFetching:!0,jobPositions:[],pages:[],currentPage:1,filters:{locationUid:null,categoryUid:null}});if(!t)throw new Error("Missing mountElementSelector");if(!n)throw new Error("Missing locationFilterSelector");if(!s)throw new Error("Missing categoryFilterSelector");$(this,_,t),$(this,N,n),$(this,S,s),this.initLocationFilter(),this.initCategoryFilter()}get data(){return f(this,y)}set data(t){$(this,y,{...f(this,y),...t}),this.render()}get mountElement(){return Jt(f(this,_))}get translations(){const{translations:t}=this.mountElement.dataset;return JSON.parse(t||"{}")}get endpointUrl(){const{endpoint:t}=this.mountElement.dataset;if(!t)throw new Error(`Missing "data-endpoint" attribute on the "${f(this,_)}" mount element`);return new URL(t,window.location.origin)}get detailPageUrl(){const{detailPagePath:t}=this.mountElement.dataset;if(!t)throw new Error(`Missing "data-detail-page-path" attribute on the "${f(this,_)}" mount element`);return new URL(Ht(t),window.location.origin)}initLocationFilter(){const t=document.querySelector(f(this,N));t&&t.addEventListener("change",n=>{const s=n.currentTarget;this.data={...this.data,currentPage:1,filters:{...this.data.filters,locationUid:s.value?parseInt(s.value):null}},this.fetchData()})}initCategoryFilter(){const t=document.querySelector(f(this,S));t&&t.addEventListener("change",n=>{const s=n.currentTarget;this.data={...this.data,currentPage:1,filters:{...this.data.filters,categoryUid:s.value?parseInt(s.value):null}},this.fetchData()})}async fetchData(){this.data={...this.data,isFetching:!0};const t=await fetch(Zt(this.endpointUrl,this.data));if(!t.ok)throw new Error(t.statusText);const{jobPositions:n,pages:s}=await t.json();this.data={...this.data,isFetching:!1,jobPositions:n,pages:s}}async render(){const{data:t}=this;if(t.isFetching){I(this.mountElement,g`<div class="bw-jobs-list">
          <div class="bw-jobs-list__loader">${Qt()}</div>
        </div>`);return}if(!t.jobPositions.length){const n=!!(t.filters.locationUid||t.filters.categoryUid);I(this.mountElement,g`<div class="bw-jobs-empty bw-jobs-body">
          ${this.translations[n?"nothingFound":"nothingPosted"]}
        </div>`);return}I(this.mountElement,g`<div class="bw-jobs-list">
        ${t.jobPositions.map(n=>{const s=`${this.detailPageUrl}/${Vt(n.slug)}`;return ne(n,s)})}
        ${Yt(t.pages,t.currentPage,n=>{this.data={...this.data,currentPage:n},this.fetchData()})}
      </div>`)}async mount(){this.fetchData()}}_=new WeakMap,N=new WeakMap,S=new WeakMap,y=new WeakMap;const ie=new se("#bw-jobs-list","#bw-jobs-location-filter","#bw-jobs-category-filter");ie.mount();
