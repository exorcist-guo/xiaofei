import{r as e,o as a,a as l,c as t,w as s,i as o,b as r,g as n,v as d,I as u}from"./index-54954f30.js";import{e as c}from"./user.c7eff9c5.js";import{_ as p}from"./_plugin-vue_export-helper.1b428a4d.js";import"./request.a96bd30e.js";const m=p({__name:"transfer",setup(p){const m=e({number:"",amount:"",trade_password:""});a((()=>{}));const f=async()=>{await c(m),d({title:"操作成功",icon:"none"})};return(e,a)=>{const d=o,c=u;return l(),t(d,{class:"page flex-column-start-center"},{default:s((()=>[r(d,{class:"card"},{default:s((()=>[r(d,{class:"title"},{default:s((()=>[n("互转的数量")])),_:1}),r(d,{class:"content flex-start-center-nowrap"},{default:s((()=>[r(c,{class:"flex-1",modelValue:m.amount,"onUpdate:modelValue":a[0]||(a[0]=e=>m.amount=e),placeholder:"9993"},null,8,["modelValue"]),r(d,{class:"text"},{default:s((()=>[n("全部互转")])),_:1})])),_:1}),r(d,{class:"flex-row-between-nowrap footer"},{default:s((()=>[r(d,{class:"label"},{default:s((()=>[n("*互转后不可退回")])),_:1})])),_:1})])),_:1}),r(d,{class:"line-input flex-start-center-nowrap"},{default:s((()=>[r(c,{class:"text",modelValue:m.number,"onUpdate:modelValue":a[1]||(a[1]=e=>m.number=e),placeholder:"手机号/账号","placeholder-class":"text"},null,8,["modelValue"])])),_:1}),r(d,{class:"line-input flex-start-center-nowrap"},{default:s((()=>[r(c,{class:"text",modelValue:m.trade_password,"onUpdate:modelValue":a[2]||(a[2]=e=>m.trade_password=e),placeholder:"操作密码","placeholder-class":"text"},null,8,["modelValue"])])),_:1}),r(d,{class:"btn",onClick:f},{default:s((()=>[n("确认")])),_:1})])),_:1})}}},[["__scopeId","data-v-6ea156d8"]]);export{m as default};
