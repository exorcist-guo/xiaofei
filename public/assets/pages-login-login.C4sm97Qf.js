import{_ as a,r as e,f as l,p as s,q as t,v as o,a as n,w as r,i,o as c,b as d,d as p,t as u,e as g,x as f,k as m,I as _}from"./index-BEqQdWRH.js";import{_ as x,a as w,b}from"./show.B0O9Pu_2.js";import{l as h,i as k}from"./user.CjjuMY_U.js";import{a as y}from"./uni-app.es.B3bw7ZBL.js";import"./request.DbuUKIcC.js";const $=a({__name:"login",setup(a){const $=e(!1),V=l({mobile:"",password:""});y((a=>{a.hasOwnProperty("zhitonglog")&&(console.log(a.zhitonglog),s("token",a.zhitonglog),t({url:"/pages/user/index"}))})),o((()=>{}));const j=()=>{h(V).then((async({data:a})=>{console.log(a),s("token",a.token);const e=await k();s("userInfo",e.data),a.is_real?t({url:"/pages/index/index"}):f({url:"/pages/login/realName"})}))};return(a,e)=>{const l=i,s=m,t=_;return c(),n(l,{class:"page flex-center-center"},{default:r((()=>[d(l,null,{default:r((()=>[d(l,{class:"title"},{default:r((()=>[p(u(a.$t("login.login.title")),1)])),_:1}),d(l,{class:"input-area flex-start-center-nowrap"},{default:r((()=>[d(l,{class:"icon"},{default:r((()=>[d(s,{class:"image",src:x})])),_:1}),d(t,{name:"account",modelValue:V.mobile,"onUpdate:modelValue":e[0]||(e[0]=a=>V.mobile=a),class:"input flex-1",type:"text",placeholder:a.$t("login.login.account")},null,8,["modelValue","placeholder"])])),_:1}),d(l,{class:"input-area flex-start-center-nowrap"},{default:r((()=>[d(l,{class:"icon"},{default:r((()=>[d(s,{class:"image",src:w})])),_:1}),d(t,{name:"password",modelValue:V.password,"onUpdate:modelValue":e[1]||(e[1]=a=>V.password=a),type:$.value?"text":"password",class:"input flex-1",placeholder:a.$t("login.register.password")},null,8,["modelValue","type","placeholder"]),d(l,{class:"icon",onClick:e[2]||(e[2]=a=>$.value=!$.value)},{default:r((()=>[d(s,{class:"image",src:b})])),_:1})])),_:1}),d(l,{class:"flex-row-between-nowrap label-area"},{default:r((()=>[d(l,{class:"ll",onClick:e[3]||(e[3]=e=>a.toUrl("/pages/login/fogetPassWord"))},{default:r((()=>[p(u(a.$t("login.login.forgetPass")),1)])),_:1}),d(l,{class:"ll register",onClick:e[4]||(e[4]=e=>a.toUrl("/pages/first/index?type=1"))},{default:r((()=>[p(u(a.$t("login.login.regest")),1)])),_:1})])),_:1}),d(l,{class:"btn",onClick:j},{default:r((()=>[p(u(a.$t("login.login.btn1")),1)])),_:1}),d(l,{class:"btn line",onClick:e[5]||(e[5]=e=>a.toUrl("/pages/first/index?type=0"))},{default:r((()=>[p(u(a.$t("login.login.btn3")),1)])),_:1}),g("",!0)])),_:1})])),_:1})}}},[["__scopeId","data-v-b2d51480"]]);export{$ as default};
