import{_ as a,u as s,r as t,g as e,z as l,a as o,w as c,i as n,o as r,b as i,L as u,e as d,h as p,j as _,F as m,S as f,d as g,t as v,q as j,J as k}from"./index-DwE6jKB5.js";import{a as q}from"./uni-app.es.coLHIkIm.js";import{p as b}from"./question.CR2pb9Dg.js";import"./request.iDM26VIX.js";const h=a({__name:"list",setup(a){const{t:h}=s();t({});const x=t(1);q((()=>{e({title:h("notice.list.nTitle")}),w()}));const y=t([]),w=()=>{l(),b({page:x.value}).then((({data:a})=>{console.log("proclamationList",a),y.value=a,x.value+=1}))};return(a,s)=>{const t=n,e=f;return r(),o(t,{class:"page"},{default:c((()=>[i(e,{class:"scroll","scroll-y":"",onScrolltolower:w},{default:c((()=>[y.value.length?d("",!0):(r(),o(u,{key:0})),(r(!0),p(m,null,_(y.value,(a=>(r(),o(t,{class:"item",key:a,onClick:s=>(a=>{j("noticeItem",a),k({url:"/pages/notice/detail"})})(a)},{default:c((()=>[i(t,{class:"title noread"},{default:c((()=>[g(v(a.title),1)])),_:2},1024),i(t,{class:"context"},{default:c((()=>[g(v(a.abstract),1)])),_:2},1024),i(t,{class:"date"},{default:c((()=>[g(v(a.created_at),1)])),_:2},1024)])),_:2},1032,["onClick"])))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-5ee968b3"]]);export{h as default};
