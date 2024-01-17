function P(s,i,e,r){function o(t){return t instanceof e?t:new e(function(n){n(t)})}return new(e||(e=Promise))(function(t,n){function l(a){try{c(r.next(a))}catch(h){n(h)}}function f(a){try{c(r.throw(a))}catch(h){n(h)}}function c(a){a.done?t(a.value):o(a.value).then(l,f)}c((r=r.apply(s,i||[])).next())})}var L=function s(i,e){if(i===e)return!0;if(i&&e&&typeof i=="object"&&typeof e=="object"){if(i.constructor!==e.constructor)return!1;var r,o,t;if(Array.isArray(i)){if(r=i.length,r!=e.length)return!1;for(o=r;o--!==0;)if(!s(i[o],e[o]))return!1;return!0}if(i.constructor===RegExp)return i.source===e.source&&i.flags===e.flags;if(i.valueOf!==Object.prototype.valueOf)return i.valueOf()===e.valueOf();if(i.toString!==Object.prototype.toString)return i.toString()===e.toString();if(t=Object.keys(i),r=t.length,r!==Object.keys(e).length)return!1;for(o=r;o--!==0;)if(!Object.prototype.hasOwnProperty.call(e,t[o]))return!1;for(o=r;o--!==0;){var n=t[o];if(!s(i[n],e[n]))return!1}return!0}return i!==i&&e!==e},k="__googleMapsScriptId",u;(function(s){s[s.INITIALIZED=0]="INITIALIZED",s[s.LOADING=1]="LOADING",s[s.SUCCESS=2]="SUCCESS",s[s.FAILURE=3]="FAILURE"})(u||(u={}));var v=class s{constructor({apiKey:i,authReferrerPolicy:e,channel:r,client:o,id:t=k,language:n,libraries:l=[],mapIds:f,nonce:c,region:a,retries:h=3,url:g="https://maps.googleapis.com/maps/api/js",version:p}){if(this.callbacks=[],this.done=!1,this.loading=!1,this.errors=[],this.apiKey=i,this.authReferrerPolicy=e,this.channel=r,this.client=o,this.id=t||k,this.language=n,this.libraries=l,this.mapIds=f,this.nonce=c,this.region=a,this.retries=h,this.url=g,this.version=p,s.instance){if(!L(this.options,s.instance.options))throw new Error(`Loader must not be called again with different options. ${JSON.stringify(this.options)} !== ${JSON.stringify(s.instance.options)}`);return s.instance}s.instance=this}get options(){return{version:this.version,apiKey:this.apiKey,channel:this.channel,client:this.client,id:this.id,libraries:this.libraries,language:this.language,region:this.region,mapIds:this.mapIds,nonce:this.nonce,url:this.url,authReferrerPolicy:this.authReferrerPolicy}}get status(){return this.errors.length?u.FAILURE:this.done?u.SUCCESS:this.loading?u.LOADING:u.INITIALIZED}get failed(){return this.done&&!this.loading&&this.errors.length>=this.retries+1}createUrl(){let i=this.url;return i+="?callback=__googleMapsCallback",this.apiKey&&(i+=`&key=${this.apiKey}`),this.channel&&(i+=`&channel=${this.channel}`),this.client&&(i+=`&client=${this.client}`),this.libraries.length>0&&(i+=`&libraries=${this.libraries.join(",")}`),this.language&&(i+=`&language=${this.language}`),this.region&&(i+=`&region=${this.region}`),this.version&&(i+=`&v=${this.version}`),this.mapIds&&(i+=`&map_ids=${this.mapIds.join(",")}`),this.authReferrerPolicy&&(i+=`&auth_referrer_policy=${this.authReferrerPolicy}`),i}deleteScript(){let i=document.getElementById(this.id);i&&i.remove()}load(){return this.loadPromise()}loadPromise(){return new Promise((i,e)=>{this.loadCallback(r=>{r?e(r.error):i(window.google)})})}importLibrary(i){return this.execute(),google.maps.importLibrary(i)}loadCallback(i){this.callbacks.push(i),this.execute()}setScript(){var i,e;if(document.getElementById(this.id)){this.callback();return}let r={key:this.apiKey,channel:this.channel,client:this.client,libraries:this.libraries.length&&this.libraries,v:this.version,mapIds:this.mapIds,language:this.language,region:this.region,authReferrerPolicy:this.authReferrerPolicy};Object.keys(r).forEach(t=>!r[t]&&delete r[t]),!((e=(i=window?.google)===null||i===void 0?void 0:i.maps)===null||e===void 0)&&e.importLibrary||(t=>{let n,l,f,c="The Google Maps JavaScript API",a="google",h="importLibrary",g="__ib__",p=document,d=window;d=d[a]||(d[a]={});let m=d.maps||(d.maps={}),E=new Set,y=new URLSearchParams,S=()=>n||(n=new Promise((w,b)=>P(this,void 0,void 0,function*(){var I;yield l=p.createElement("script"),l.id=this.id,y.set("libraries",[...E]+"");for(f in t)y.set(f.replace(/[A-Z]/g,O=>"_"+O[0].toLowerCase()),t[f]);y.set("callback",a+".maps."+g),l.src=this.url+"?"+y,m[g]=w,l.onerror=()=>n=b(Error(c+" could not load.")),l.nonce=this.nonce||((I=p.querySelector("script[nonce]"))===null||I===void 0?void 0:I.nonce)||"",p.head.append(l)})));m[h]?console.warn(c+" only loads once. Ignoring:",t):m[h]=(w,...b)=>E.add(w)&&S().then(()=>m[h](w,...b))})(r);let o=this.libraries.map(t=>this.importLibrary(t));o.length||o.push(this.importLibrary("core")),Promise.all(o).then(()=>this.callback(),t=>{let n=new ErrorEvent("error",{error:t});this.loadErrorCallback(n)})}reset(){this.deleteScript(),this.done=!1,this.loading=!1,this.errors=[],this.onerrorEvent=null}resetIfRetryingFailed(){this.failed&&this.reset()}loadErrorCallback(i){if(this.errors.push(i),this.errors.length<=this.retries){let e=this.errors.length*Math.pow(2,this.errors.length);console.error(`Failed to load Google Maps script, retrying in ${e} ms.`),setTimeout(()=>{this.deleteScript(),this.setScript()},e)}else this.onerrorEvent=i,this.callback()}callback(){this.done=!0,this.loading=!1,this.callbacks.forEach(i=>{i(this.onerrorEvent)}),this.callbacks=[]}execute(){if(this.resetIfRetryingFailed(),this.done)this.callback();else{if(window.google&&window.google.maps&&window.google.maps.version){console.warn("Google Maps already loaded outside @googlemaps/js-api-loader.This may result in undesirable behavior as options and script parameters may not match."),this.callback();return}this.loading||(this.loading=!0,this.setScript())}}};function A({location:s,config:i}){return{map:null,marker:null,markerLocation:null,loader:null,location:null,config:{defaultLocation:{lat:0,lng:0},defaultZoom:8,apiKey:""},init:function(){this.location=s,this.config={...this.config,...i},this.loadGmaps()},loadGmaps:function(){this.loader=new v({apiKey:this.config.apiKey,version:"weekly"}),this.loader.load().then(e=>{this.map=new e.maps.Map(this.$refs.map,{center:this.getCoordinates(),zoom:this.config.defaultZoom,...this.config.controls}),this.marker=new e.maps.Marker({map:this.map}),this.marker.setPosition(this.getCoordinates())}).catch(e=>{console.error("Error loading Google Maps API:",e)})},getCoordinates:function(){let e=JSON.parse(this.location);return(e===null||!e.hasOwnProperty("lat")||!e.hasOwnProperty("lng"))&&(e={lat:this.config.defaultLocation.lat,lng:this.config.defaultLocation.lng}),e}}}export{A as default};
/*! Bundled license information:

@googlemaps/js-api-loader/dist/index.esm.js:
  (*! *****************************************************************************
  Copyright (c) Microsoft Corporation.
  
  Permission to use, copy, modify, and/or distribute this software for any
  purpose with or without fee is hereby granted.
  
  THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
  REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
  AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
  INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
  LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
  OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
  PERFORMANCE OF THIS SOFTWARE.
  ***************************************************************************** *)
*/