import{_ as e,u as a,f as s,r as t,v as l,y as r,a as o,w as u,i as n,o as d,b as c,d as p,t as f,B as m,x as i,I as _}from"./index-BmcB0U46.js";import{d as x}from"./data.BuGXBoPB.js";import{o as w}from"./uni-app.es.DuZXDk0Y.js";import"./request.D2_Qjmr4.js";const h=e({__name:"transfer",setup(e){const{t:h}=a(),b=s({number:"",amount:"",trade_password:""}),V=t(0);l((()=>{V.value=r("userInfo").dikouquan_k})),w((()=>{V.value=r("userInfo").dikouquan_k}));const k=async()=>{try{const{data:e}=await x(b);m({title:h("user.push.sucess"),icon:"none"}),i({url:"/pages/data/coupon"})}catch(e){m({title:e.msg,icon:"none"})}};return(e,a)=>{const s=n,t=_;return d(),o(s,{class:"page flex-column-start-center"},{default:u((()=>[c(s,{class:"card"},{default:u((()=>[c(s,{class:"title"},{default:u((()=>[p(f(e.$t("user.transfer.title")),1)])),_:1}),c(s,{class:"content flex-start-center-nowrap"},{default:u((()=>[c(t,{class:"flex-1",modelValue:b.amount,"onUpdate:modelValue":a[0]||(a[0]=e=>b.amount=e),placeholder:V.value},null,8,["modelValue","placeholder"]),c(s,{class:"text",onClick:a[1]||(a[1]=e=>b.amount=V.value)},{default:u((()=>[p(f(e.$t("user.transfer.text")),1)])),_:1})])),_:1}),c(s,{class:"flex-row-between-nowrap footer"},{default:u((()=>[c(s,{class:"label"},{default:u((()=>[p("*"+f(e.$t("user.transfer.label")),1)])),_:1})])),_:1})])),_:1}),c(s,{class:"line-input flex-start-center-nowrap"},{default:u((()=>[c(t,{class:"text",modelValue:b.number,"onUpdate:modelValue":a[2]||(a[2]=e=>b.number=e),placeholder:e.$t("user.transfer.number"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),c(s,{class:"line-input flex-start-center-nowrap"},{default:u((()=>[c(t,{class:"text",type:"password",modelValue:b.trade_password,"onUpdate:modelValue":a[3]||(a[3]=e=>b.trade_password=e),placeholder:e.$t("user.push.tradePassword"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),c(s,{class:"btn",onClick:k},{default:u((()=>[p(f(e.$t("user.push.confirm")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-4aa89ae8"]]);export{h as default};
