import{_ as e,u as a,r as l,f as t,v as s,y as o,z as r,A as n,a as c,w as i,i as u,o as d,b as p,e as m,d as f,t as g,B as h,G as v,I as y,k as w}from"./index-DcL-eM9n.js";import{c as x}from"./uni-app.es.D-Srqxsy.js";import{c as _,u as b,a as V}from"./user.BD26lrUX.js";import"./request.nusU8foJ.js";const k=e({__name:"setPassWord",setup(e){const{t:k}=a(),P=l(!1),I=l(0),$=l({img:"",key:""}),T=t({mobile:"",invite_mobile:"",verify:"",password:"",realPassword:"",captcha:""}),U=l(!1);x((()=>{clearInterval(globalThis.inter)})),s((()=>{W(),T.mobile=o("userInfo").mobile,U.value=0==o("userInfo").is_set_transaction_password}));const W=()=>{r({mask:!0}),_({type:"trade_password"}).then((({data:e})=>{$.value=e.url,n()}))},j=async()=>{if(T.mobile.trim().length,!T.captcha)return h({title:k("login.register.regCaptcha"),icon:"none"}),!1;try{const{data:e}=await b({key:$.value.key,type:"trade_password",captcha:T.captcha});h({title:k("login.register.sendSucess"),icon:"none"}),P.value=!0,I.value=60,globalThis.inter=setInterval((()=>{console.log(I.value),I.value-=1,0==I.value&&(clearInterval(globalThis.inter),P.value=!1)}),1e3)}catch(e){setTimeout((()=>{W()}),1e3)}},C=async()=>{if(T.password!=T.realPassword)return h({title:k("login.register.faillPass"),icon:"none"}),!1;const e={mobile:T.mobile,password:T.password,verify:null==T?void 0:T.verify};console.log(e),await V(e),h({title:k("login.forgetPassWord.changeSucess")}),setTimeout((()=>{v()}),1e3)};return(e,a)=>{const l=y,t=u,s=w;return d(),c(t,{class:"page flex-column-start-center"},{default:i((()=>[U.value?m("",!0):(d(),c(t,{key:0,class:"flex-start-center-nowrap"},{default:i((()=>[p(t,{class:"input-area flex-start-center-nowrap",style:{width:"384rpx"}},{default:i((()=>[p(l,{name:"account",modelValue:T.captcha,"onUpdate:modelValue":a[0]||(a[0]=e=>T.captcha=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.captcha")},null,8,["modelValue","placeholder"])])),_:1}),p(s,{class:"verify",mode:"widthFix",src:$.value.img,onClick:W},null,8,["src"])])),_:1})),U.value?m("",!0):(d(),c(t,{key:1,class:"input-area flex-start-center-nowrap"},{default:i((()=>[p(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.mobile"),disabled:"",modelValue:T.mobile,"onUpdate:modelValue":a[1]||(a[1]=e=>T.mobile=e)},null,8,["placeholder","modelValue"]),P.value?(d(),c(t,{key:1,class:"get-code get"},{default:i((()=>[f(g(I.value)+"s",1)])),_:1})):(d(),c(t,{key:0,class:"get-code gray",onClick:j},{default:i((()=>[f(g(e.$t("login.register.getVerify")),1)])),_:1}))])),_:1})),U.value?m("",!0):(d(),c(t,{key:2,class:"input-area flex-start-center-nowrap"},{default:i((()=>[p(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.forgetPassWord.verify"),modelValue:T.verify,"onUpdate:modelValue":a[2]||(a[2]=e=>T.verify=e)},null,8,["placeholder","modelValue"])])),_:1})),p(t,{class:"input-area flex-start-center-nowrap"},{default:i((()=>[p(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.forgetPassWord.password"),modelValue:T.password,"onUpdate:modelValue":a[3]||(a[3]=e=>T.password=e)},null,8,["placeholder","modelValue"])])),_:1}),p(t,{class:"input-area flex-start-center-nowrap"},{default:i((()=>[p(l,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.forgetPassWord.realPassword"),modelValue:T.realPassword,"onUpdate:modelValue":a[4]||(a[4]=e=>T.realPassword=e)},null,8,["placeholder","modelValue"])])),_:1}),p(t,{class:"btn",onClick:C},{default:i((()=>[f(g(e.$t("login.register.post")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-6b2cde0b"]]);export{k as default};
