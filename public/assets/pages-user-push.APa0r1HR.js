import{_ as a,u as e,f as s,r as t,v as l,y as o,g as u,a as r,w as n,i as d,o as c,b as p,d as f,t as i,B as m,x as _,I as h}from"./index-CW723B5c.js";import{c as w}from"./data.C64pGWom.js";import{o as x}from"./uni-app.es.DUFC0knK.js";import"./request.DqHAI5UG.js";const k=a({__name:"push",setup(a){const{t:k}=e(),v=s({amount:"",trade_password:""}),V=t(0);l((()=>{V.value=o("userInfo").dikouquan_k,u({title:k("user.push.nTitle")})})),x((()=>{V.value=o("userInfo").dikouquan_k}));const b=async()=>{try{const{data:a}=await w(v);m({title:k("user.push.sucess"),icon:"none"}),_({url:"/pages/data/coupon"})}catch(a){m({title:a.msg,icon:"none"})}};return(a,e)=>{const s=d,t=h;return c(),r(s,{class:"page flex-column-start-center"},{default:n((()=>[p(s,{class:"card"},{default:n((()=>[p(s,{class:"title"},{default:n((()=>[f(i(a.$t("user.push.title")),1)])),_:1}),p(s,{class:"content flex-start-center-nowrap"},{default:n((()=>[p(t,{class:"flex-1",modelValue:v.amount,"onUpdate:modelValue":e[0]||(e[0]=a=>v.amount=a),placeholder:V.value},null,8,["modelValue","placeholder"]),p(s,{class:"text",onClick:e[1]||(e[1]=a=>v.amount=V.value)},{default:n((()=>[f(i(a.$t("user.push.text")),1)])),_:1})])),_:1}),p(s,{class:"flex-row-between-nowrap footer"},{default:n((()=>[p(s,{class:"label"},{default:n((()=>[f("*"+i(a.$t("user.push.label")),1)])),_:1})])),_:1})])),_:1}),p(s,{class:"line-input flex-start-center-nowrap"},{default:n((()=>[p(t,{class:"text",type:"password",modelValue:v.trade_password,"onUpdate:modelValue":e[2]||(e[2]=a=>v.trade_password=a),placeholder:a.$t("user.push.tradePassword"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(s,{class:"btn",onClick:b},{default:n((()=>[f(i(a.$t("user.push.confirm")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-6459a82e"]]);export{k as default};
