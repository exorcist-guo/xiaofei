import{_ as e,u as a,r as l,f as t,v as s,y as o,g as r,z as n,A as i,a as c,w as u,i as d,o as p,b as m,e as f,d as g,t as h,B as v,G as y,I as x,k as w}from"./index-DWXj2XL_.js";import{c as _}from"./uni-app.es.Rr7Fi8cl.js";import{c as b,u as V,a as k}from"./user.DhQycmBg.js";import"./request.BZtEVHaK.js";const P=e({__name:"setPassWord",setup(e){const{t:P}=a(),I=l(!1),W=l(0),$=l({img:"",key:""}),T=t({mobile:"",invite_mobile:"",verify:"",password:"",realPassword:"",captcha:""}),U=l(!1);_((()=>{clearInterval(globalThis.inter)})),s((()=>{j(),T.mobile=o("userInfo").mobile,U.value=0==o("userInfo").is_set_transaction_password,U.value?r({title:P("user.index.setPassWord")}):r({title:P("user.index.changePassWord")})}));const j=()=>{n({mask:!0}),b({type:"trade_password"}).then((({data:e})=>{$.value=e.url,i()}))},C=async()=>{if(T.mobile.trim().length,!T.captcha)return v({title:P("login.register.regCaptcha"),icon:"none"}),!1;try{const{data:e}=await V({key:$.value.key,type:"trade_password",captcha:T.captcha});v({title:P("login.register.sendSucess"),icon:"none"}),I.value=!0,W.value=60,globalThis.inter=setInterval((()=>{console.log(W.value),W.value-=1,0==W.value&&(clearInterval(globalThis.inter),I.value=!1)}),1e3)}catch(e){setTimeout((()=>{j()}),1e3)}},S=async()=>{if(T.password!=T.realPassword)return v({title:P("login.register.faillPass"),icon:"none"}),!1;const e={mobile:T.mobile,password:T.password,verify:null==T?void 0:T.verify};console.log(e),await k(e),v({title:P("login.forgetPassWord.changeSucess")}),setTimeout((()=>{y()}),1e3)};return(e,a)=>{const l=x,t=d,s=w;return p(),c(t,{class:"page flex-column-start-center"},{default:u((()=>[U.value?f("",!0):(p(),c(t,{key:0,class:"flex-start-center-nowrap"},{default:u((()=>[m(t,{class:"input-area flex-start-center-nowrap",style:{width:"384rpx"}},{default:u((()=>[m(l,{name:"account",modelValue:T.captcha,"onUpdate:modelValue":a[0]||(a[0]=e=>T.captcha=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.captcha")},null,8,["modelValue","placeholder"])])),_:1}),m(s,{class:"verify",mode:"widthFix",src:$.value.img,onClick:j},null,8,["src"])])),_:1})),U.value?f("",!0):(p(),c(t,{key:1,class:"input-area flex-start-center-nowrap"},{default:u((()=>[m(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.mobile"),disabled:"",modelValue:T.mobile,"onUpdate:modelValue":a[1]||(a[1]=e=>T.mobile=e)},null,8,["placeholder","modelValue"]),I.value?(p(),c(t,{key:1,class:"get-code get"},{default:u((()=>[g(h(W.value)+"s",1)])),_:1})):(p(),c(t,{key:0,class:"get-code gray",onClick:C},{default:u((()=>[g(h(e.$t("login.register.getVerify")),1)])),_:1}))])),_:1})),U.value?f("",!0):(p(),c(t,{key:2,class:"input-area flex-start-center-nowrap"},{default:u((()=>[m(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.forgetPassWord.verify"),modelValue:T.verify,"onUpdate:modelValue":a[2]||(a[2]=e=>T.verify=e)},null,8,["placeholder","modelValue"])])),_:1})),m(t,{class:"input-area flex-start-center-nowrap"},{default:u((()=>[m(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.forgetPassWord.password"),modelValue:T.password,"onUpdate:modelValue":a[3]||(a[3]=e=>T.password=e)},null,8,["placeholder","modelValue"])])),_:1}),m(t,{class:"input-area flex-start-center-nowrap"},{default:u((()=>[m(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.forgetPassWord.realPassword"),modelValue:T.realPassword,"onUpdate:modelValue":a[4]||(a[4]=e=>T.realPassword=e)},null,8,["placeholder","modelValue"])])),_:1}),m(t,{class:"btn",onClick:S},{default:u((()=>[g(h(e.$t("login.register.post")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-9f3d3709"]]);export{P as default};
