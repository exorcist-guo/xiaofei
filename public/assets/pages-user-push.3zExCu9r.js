import{_ as a,u as e,f as s,r as t,v as l,y as o,g as u,a as r,w as n,i as d,o as c,b as p,d as f,t as i,B as m,I as _}from"./index-DcL-eM9n.js";import{c as h}from"./data.D6RHvXHN.js";import"./request.nusU8foJ.js";const w=a({__name:"push",setup(a){const{t:w}=e(),x=s({amount:"",trade_password:""}),b=t(0);l((()=>{b.value=o("userInfo").dikouquan_k,u({title:w("user.push.nTitle")})}));const V=async()=>{try{const{data:a}=await h(x);m({title:w("user.push.sucess"),icon:"none"})}catch(a){m({title:a.msg,icon:"none"})}};return(a,e)=>{const s=d,t=_;return c(),r(s,{class:"page flex-column-start-center"},{default:n((()=>[p(s,{class:"card"},{default:n((()=>[p(s,{class:"title"},{default:n((()=>[f(i(a.$t("user.push.title")),1)])),_:1}),p(s,{class:"content flex-start-center-nowrap"},{default:n((()=>[p(t,{class:"flex-1",modelValue:x.amount,"onUpdate:modelValue":e[0]||(e[0]=a=>x.amount=a),placeholder:b.value},null,8,["modelValue","placeholder"]),p(s,{class:"text",onClick:e[1]||(e[1]=a=>x.amount=b.value)},{default:n((()=>[f(i(a.$t("user.push.text")),1)])),_:1})])),_:1}),p(s,{class:"flex-row-between-nowrap footer"},{default:n((()=>[p(s,{class:"label"},{default:n((()=>[f("*"+i(a.$t("user.push.label")),1)])),_:1})])),_:1})])),_:1}),p(s,{class:"line-input flex-start-center-nowrap"},{default:n((()=>[p(t,{class:"text",type:"password",modelValue:x.trade_password,"onUpdate:modelValue":e[2]||(e[2]=a=>x.trade_password=a),placeholder:a.$t("user.push.tradePassword"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(s,{class:"btn",onClick:V},{default:n((()=>[f(i(a.$t("user.push.confirm")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-cb7394d1"]]);export{w as default};
