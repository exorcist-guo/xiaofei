import{_ as e,u as a,r as s,f as l,g as t,H as n,J as o,a as u,w as i,i as d,o as c,b as r,d as p,t as m,C as f,h as q,j as x,F as h,z as _,A as b,B as g,K as V,I as j,l as y}from"./index-BRXUfIsq.js";import{a as k,d as C}from"./uni-app.es.DDCqBda2.js";import{m as v,s as w}from"./question.CcYnEKDq.js";import"./request.DZBRZmUR.js";const U=e({__name:"index",setup(e){const{t:U}=a();s(0);const H=l({mobile:"",name:"",question:"",type:1}),I=s({});k((()=>{t({title:U("question.index.nTitle")}),n((()=>{document.querySelector(".uni-page-head-ft .uni-page-head-btn .uni-btn-icon").innerHTML=U("question.index.button")})),v().then((({data:e})=>{console.log(e),I.value=e}))})),C((()=>{o({url:"/pages/question/list"})}));const T=()=>{_(),w(H).then((e=>{b(),console.log(e),g({title:e.msg,icon:"noen"})}))};return(e,a)=>{const s=d,l=V,t=j;return c(),u(s,{class:"page"},{default:i((()=>[r(s,{class:"title"},{default:i((()=>[p(m(f(U)("question.index.tt1")),1)])),_:1}),r(s,{class:"label-area flex-row-start-center-wrap"},{default:i((()=>[(c(!0),q(h,null,x(I.value,((e,a)=>(c(),u(s,{class:y(["label",{bind:H.type==a}]),key:a,onClick:e=>H.type=a},{default:i((()=>[p(m(e),1)])),_:2},1032,["class","onClick"])))),128))])),_:1}),r(s,{class:"title"},{default:i((()=>[p(m(f(U)("question.index.tt2")),1)])),_:1}),r(s,{class:"text-area"},{default:i((()=>[r(l,{class:"textarea",modelValue:H.question,"onUpdate:modelValue":a[0]||(a[0]=e=>H.question=e),maxlength:200,placeholder:f(U)("question.index.content")},null,8,["modelValue","placeholder"]),r(s,{class:"tips"},{default:i((()=>[p(m(H.question.length)+"/200",1)])),_:1})])),_:1}),r(s,{class:"title"},{default:i((()=>[p(m(f(U)("question.index.tt3")),1)])),_:1}),r(t,{class:"input",modelValue:H.name,"onUpdate:modelValue":a[1]||(a[1]=e=>H.name=e),placeholder:f(U)("question.index.name")},null,8,["modelValue","placeholder"]),r(t,{class:"input",modelValue:H.mobile,"onUpdate:modelValue":a[2]||(a[2]=e=>H.mobile=e),placeholder:f(U)("question.index.mobile")},null,8,["modelValue","placeholder"]),r(s,{class:"btn",onClick:T},{default:i((()=>[p(m(e.$t("user.push.confirm")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-c12f0b59"]]);export{U as default};
