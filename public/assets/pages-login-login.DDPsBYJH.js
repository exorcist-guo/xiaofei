import{_ as e,u as a,r as l,f as s,p as o,q as t,v as n,a as i,w as r,i as c,o as d,b as u,d as g,t as p,e as f,x as m,y as _,k as x,I as w}from"./index-DV5gXwyS.js";import{_ as b,a as h,b as k}from"./show.B0O9Pu_2.js";import{l as y,i as v}from"./user.DOE48SVR.js";import{a as $}from"./uni-app.es.iHn-elbW.js";import"./request.8kQxyx6u.js";const j=e({__name:"login",setup(e){const{t:j}=a(),V=l(!1),C=s({mobile:"",password:""});$((e=>{e.hasOwnProperty("zhitonglog")&&(console.log(e.zhitonglog),o("token",e.zhitonglog),t({url:"/pages/user/index"}))})),n((()=>{}));const U=()=>{y(C).then((async({data:e})=>{if(console.log(e),5==e.m_info.is_disabled)return m({title:j("login.login.disabled5"),icon:"none",duration:3e3}),o("m_info",e.m_info),void setTimeout((()=>{_({url:"/pages/login/registerj"})}),3e3);o("m_info",""),o("token",e.token);const a=await v();o("userInfo",a.data),e.is_real?t({url:"/pages/index/index"}):_({url:"/pages/login/realName"})}))};return(e,a)=>{const l=c,s=x,o=w;return d(),i(l,{class:"page flex-center-center"},{default:r((()=>[u(l,null,{default:r((()=>[u(l,{class:"title"},{default:r((()=>[g(p(e.$t("login.login.title")),1)])),_:1}),u(l,{class:"input-area flex-start-center-nowrap"},{default:r((()=>[u(l,{class:"icon"},{default:r((()=>[u(s,{class:"image",src:b})])),_:1}),u(o,{name:"account",modelValue:C.mobile,"onUpdate:modelValue":a[0]||(a[0]=e=>C.mobile=e),class:"input flex-1",type:"text",placeholder:e.$t("login.login.account")},null,8,["modelValue","placeholder"])])),_:1}),u(l,{class:"input-area flex-start-center-nowrap"},{default:r((()=>[u(l,{class:"icon"},{default:r((()=>[u(s,{class:"image",src:h})])),_:1}),u(o,{name:"password",modelValue:C.password,"onUpdate:modelValue":a[1]||(a[1]=e=>C.password=e),type:V.value?"text":"password",class:"input flex-1",placeholder:e.$t("login.register.password")},null,8,["modelValue","type","placeholder"]),u(l,{class:"icon",onClick:a[2]||(a[2]=e=>V.value=!V.value)},{default:r((()=>[u(s,{class:"image",src:k})])),_:1})])),_:1}),u(l,{class:"flex-row-between-nowrap label-area"},{default:r((()=>[u(l,{class:"ll",onClick:a[3]||(a[3]=a=>e.toUrl("/pages/login/fogetPassWord"))},{default:r((()=>[g(p(e.$t("login.login.forgetPass")),1)])),_:1}),u(l,{class:"ll register",onClick:a[4]||(a[4]=a=>e.toUrl("/pages/first/index?type=1"))},{default:r((()=>[g(p(e.$t("login.login.regest")),1)])),_:1})])),_:1}),u(l,{class:"btn",onClick:U},{default:r((()=>[g(p(e.$t("login.login.btn1")),1)])),_:1}),u(l,{class:"btn line",onClick:a[5]||(a[5]=a=>e.toUrl("/pages/first/index?type=0"))},{default:r((()=>[g(p(e.$t("login.login.btn3")),1)])),_:1}),f("",!0)])),_:1})])),_:1})}}},[["__scopeId","data-v-3b3ff2c2"]]);export{j as default};
