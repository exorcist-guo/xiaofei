import{_ as a,u as s,r as t,g as e,z as l,a as o,w as c,i as n,o as r,b as i,M as u,e as d,h as p,j as _,F as m,S as f,d as g,t as v,p as j,K as k}from"./index-DAFkWXis.js";import{a as b}from"./uni-app.es.DnTCSesh.js";import{p as h}from"./question.D-y0PTY1.js";import"./request.C4qf4QEw.js";const q=a({__name:"list",setup(a){const{t:q}=s();t({});const x=t(1);b((()=>{e({title:q("notice.list.nTitle")}),w()}));const y=t([]),w=()=>{l(),h({page:x.value}).then((({data:a})=>{console.log("proclamationList",a),y.value=a,x.value+=1}))};return(a,s)=>{const t=n,e=f;return r(),o(t,{class:"page"},{default:c((()=>[i(e,{class:"scroll","scroll-y":"",onScrolltolower:w},{default:c((()=>[y.value.length?d("",!0):(r(),o(u,{key:0})),(r(!0),p(m,null,_(y.value,(a=>(r(),o(t,{class:"item",key:a,onClick:s=>(a=>{j("noticeItem",a),k({url:"/pages/notice/detail"})})(a)},{default:c((()=>[i(t,{class:"title noread"},{default:c((()=>[g(v(a.title),1)])),_:2},1024),i(t,{class:"context"},{default:c((()=>[g(v(a.abstract),1)])),_:2},1024),i(t,{class:"date"},{default:c((()=>[g(v(a.created_at),1)])),_:2},1024)])),_:2},1032,["onClick"])))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-5ee968b3"]]);export{q as default};
