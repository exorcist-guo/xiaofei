import{_ as a,u as s,r as t,g as e,A as l,a as o,w as c,i as n,o as r,b as i,M as u,e as d,h as p,j as _,F as m,S as f,d as g,t as v,p as j,K as k}from"./index-DV5gXwyS.js";import{a as b}from"./uni-app.es.iHn-elbW.js";import{p as h}from"./question.7rencCJZ.js";import"./request.8kQxyx6u.js";const x=a({__name:"list",setup(a){const{t:x}=s();t({});const y=t(1);b((()=>{e({title:x("notice.list.nTitle")}),w()}));const q=t([]),w=()=>{l(),h({page:y.value}).then((({data:a})=>{console.log("proclamationList",a),q.value=a,y.value+=1}))};return(a,s)=>{const t=n,e=f;return r(),o(t,{class:"page"},{default:c((()=>[i(e,{class:"scroll","scroll-y":"",onScrolltolower:w},{default:c((()=>[q.value.length?d("",!0):(r(),o(u,{key:0})),(r(!0),p(m,null,_(q.value,(a=>(r(),o(t,{class:"item",key:a,onClick:s=>(a=>{j("noticeItem",a),k({url:"/pages/notice/detail"})})(a)},{default:c((()=>[i(t,{class:"title noread"},{default:c((()=>[g(v(a.title),1)])),_:2},1024),i(t,{class:"context"},{default:c((()=>[g(v(a.abstract),1)])),_:2},1024),i(t,{class:"date"},{default:c((()=>[g(v(a.created_at),1)])),_:2},1024)])),_:2},1032,["onClick"])))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-5ee968b3"]]);export{x as default};
