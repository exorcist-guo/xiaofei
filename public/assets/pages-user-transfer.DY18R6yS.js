import{_ as e,u as a,f as t,r as s,p as l,y as r,a as o,w as n,i as u,o as d,b as c,d as p,t as f,B as m,I as i}from"./index-DtR9QegH.js";import{b as _}from"./data.DpTzVv4_.js";import"./request.CnzmUSE5.js";const x=e({__name:"transfer",setup(e){const{t:x}=a(),w=t({number:"",amount:"",trade_password:""}),h=s(0);l((()=>{h.value=r("userInfo").dikouquan_k}));const b=async()=>{try{const{data:e}=await _(w);m({title:x("user.push.sucess"),icon:"none"})}catch(e){m({title:e.msg,icon:"none"})}};return(e,a)=>{const t=u,s=i;return d(),o(t,{class:"page flex-column-start-center"},{default:n((()=>[c(t,{class:"card"},{default:n((()=>[c(t,{class:"title"},{default:n((()=>[p(f(e.$t("user.transfer.title")),1)])),_:1}),c(t,{class:"content flex-start-center-nowrap"},{default:n((()=>[c(s,{class:"flex-1",modelValue:w.amount,"onUpdate:modelValue":a[0]||(a[0]=e=>w.amount=e),placeholder:h.value},null,8,["modelValue","placeholder"]),c(t,{class:"text",onClick:a[1]||(a[1]=e=>w.amount=h.value)},{default:n((()=>[p(f(e.$t("user.transfer.text")),1)])),_:1})])),_:1}),c(t,{class:"flex-row-between-nowrap footer"},{default:n((()=>[c(t,{class:"label"},{default:n((()=>[p("*"+f(e.$t("user.transfer.label")),1)])),_:1})])),_:1})])),_:1}),c(t,{class:"line-input flex-start-center-nowrap"},{default:n((()=>[c(s,{class:"text",modelValue:w.number,"onUpdate:modelValue":a[2]||(a[2]=e=>w.number=e),placeholder:e.$t("user.transfer.number"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),c(t,{class:"line-input flex-start-center-nowrap"},{default:n((()=>[c(s,{class:"text",type:"password",modelValue:w.trade_password,"onUpdate:modelValue":a[3]||(a[3]=e=>w.trade_password=e),placeholder:e.$t("user.push.tradePassword"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),c(t,{class:"btn",onClick:b},{default:n((()=>[p(f(e.$t("user.push.confirm")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-1c593497"]]);export{x as default};
