import i from"./LocationForm-BoXQjVSP.js";import u from"./LocationWeather-CMKsoD3k.js";import{u as m}from"./LocationStore-DrHVDXRN.js";import{y as l,k as a,e as t,b as r,F as p,h as _,o as e}from"./app-CjOyLFBD.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./LocationHeader-B-ai6kBB.js";import"./ForecastData-6UZyClIC.js";const F={__name:"BaseLocations",setup(d){const o=m();l(()=>{o.fetchLocations()});const s=a(()=>o.getLocations),c=a(()=>o.getLocationCount);return(f,L)=>(e(),t("div",null,[r(i,{count:c.value},null,8,["count"]),(e(!0),t(p,null,_(s.value,n=>(e(),t("div",{key:n.id,class:"mt-4"},[r(u,{id:n.id},null,8,["id"])]))),128))]))}};export{F as default};
