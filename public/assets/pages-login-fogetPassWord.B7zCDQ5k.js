import{_ as e,u as a,r as l,f as t,p as s,g as o,z as r,A as n,a as i,w as c,i as u,o as d,b as p,d as m,t as g,E as f,B as h,G as x,I as w,k as y}from"./index-Ba7VW2w5.js";import{c as v}from"./uni-app.es.COkqN9dJ.js";import{c as b,v as V,p as _}from"./user.CNO83BiR.js";import"./request.BD3hgp6-.js";const P=e({__name:"fogetPassWord",setup(e){const{t:P}=a(),k=l(!1),C=l(0),I=l({img:"",key:""}),T=t({mobile:"",invite_mobile:"",verify:"",password:"",realPassword:"",captcha:""});v((()=>{clearInterval(globalThis.inter)})),s((()=>{o({title:P("login.forgetPassWord.title")}),U()}));const U=()=>{r({mask:!0}),b({type:"zh",mobile:T.mobile}).then((({data:e})=>{I.value=e.url,n()}))},W=async()=>{if(11!==T.mobile.trim().length)return h({title:P("login.register.regMobile"),icon:"none"}),!1;if(!T.captcha)return h({title:P("login.register.regCaptcha"),icon:"none"}),!1;try{const{data:e}=await V({mobile:T.mobile,key:I.value.key,type:"register",captcha:T.captcha});h({title:P("login.register.sendSucess"),icon:"none"}),k.value=!0,C.value=60,globalThis.inter=setInterval((()=>{C.value-=1,0==C.value&&(clearInterval(globalThis.inter),k.value=!1)}),1e3)}catch(e){setTimeout((()=>{U()}),1e3)}},j=async()=>{if(T.password!=T.realPassword)return h({title:P("login.register.faillPass"),icon:"none"}),!1;const e={mobile:T.mobile,password:T.password,verify:T.captcha};console.log(e),await _(e),h({title:P("login.forgetPassword.changeSucess")}),setTimeout((()=>{x()}),1e3)};return(e,a)=>{const l=w,t=u,s=y;return d(),i(t,{class:"page flex-column-start-center"},{default:c((()=>[p(t,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{name:"account",class:"input flex-1",type:"text",placeholder:"手机号",modelValue:T.mobile,"onUpdate:modelValue":a[0]||(a[0]=e=>T.mobile=e)},null,8,["modelValue"]),k.value?(d(),i(t,{key:1,class:"get-code get"},{default:c((()=>[m(g(C.value)+"s",1)])),_:1})):(d(),i(t,{key:0,class:"get-code gray",onClick:W},{default:c((()=>[m(g(e.$t("login.register.getVerify")),1)])),_:1}))])),_:1}),p(t,{class:"flex-start-center-nowrap"},{default:c((()=>[p(t,{class:"input-area flex-start-center-nowrap",style:{width:"384rpx"}},{default:c((()=>[p(l,{name:"account",modelValue:T.captcha,"onUpdate:modelValue":a[1]||(a[1]=e=>T.captcha=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:f(P)("login.register.regCaptcha")},null,8,["modelValue","placeholder"])])),_:1}),p(s,{class:"verify",mode:"widthFix",src:I.value.img,onClick:U},null,8,["src"])])),_:1}),p(t,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:f(P)("login.forgetPassWord.verify"),modelValue:T.verify,"onUpdate:modelValue":a[2]||(a[2]=e=>T.verify=e)},null,8,["placeholder","modelValue"])])),_:1}),p(t,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:f(P)("login.forgetPassWord.password"),modelValue:T.password,"onUpdate:modelValue":a[3]||(a[3]=e=>T.password=e)},null,8,["placeholder","modelValue"])])),_:1}),p(t,{class:"input-area flex-start-center-nowrap"},{default:c((()=>[p(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:f(P)("login.forgetPassWord.realPassword"),modelValue:T.realPassword,"onUpdate:modelValue":a[4]||(a[4]=e=>T.realPassword=e)},null,8,["placeholder","modelValue"])])),_:1}),p(t,{class:"btn",onClick:j},{default:c((()=>[m(g(e.$t("login.register.post")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-32eb3982"]]);export{P as default};
