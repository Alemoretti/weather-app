import{u as i}from"./LocationStore-DrHVDXRN.js";import{k as o,e as c,a as l,t as p,o as d}from"./app-CjOyLFBD.js";const u={class:"bg-indigo-500 bg-opacity-25 p-6 lg:p-8 pb-0 lg:pb-0"},m={class:"text-lg text-indigo-900 font-bold"},b={__name:"LocationHeader",props:{id:{type:Number,required:!0}},setup(e){const a=e,s=i(),t=o(()=>s.getLocationById(a.id)),n=o(()=>t.value?t.value.name.split(", ").filter(Boolean).join(", "):"");return(r,_)=>(d(),c("div",u,[l("h2",m,p(n.value),1)]))}};export{b as default};
