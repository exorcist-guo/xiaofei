import{_ as e,u as a,r as l,f as t,v as s,y as o,z as n,A as r,a as c,w as u,i as d,o as i,b as p,d as m,t as h,E as f,B as _,I as x,D as g,k as w}from"./index-BEqQdWRH.js";import{c as v,w as V,u as y,d as b}from"./user.CjjuMY_U.js";import"./request.DbuUKIcC.js";const k=e({__name:"without",setup(e){const{t:k}=a(),U=l(),C=l({img:"",key:""}),I=l(!1),$=l(0),j=t({name:"",card_name:"",card_number:"",amount:"",trade_password:"",name:"",lianhang_code:""}),N=l([]);s((()=>{U.value=o("userInfo").integral,T(),j.mobile=o("userInfo").mobile,P()}));const P=()=>{n({mask:!0}),v({type:"wit"}).then((({data:e})=>{C.value=e.url,r()}))},T=()=>{V().then((({data:e})=>{console.log(e),N.value=e.card_names,e.hasOwnProperty("collection_info")&&(j.card_name=e.collection_info.card_name,j.card_number=e.collection_info.card_number,j.name=e.collection_info.name)}))},q=async()=>{if(!j.captcha)return _({title:k("login.register.regCaptcha"),icon:"none"}),!1;try{const{data:e}=await y({key:C.value.key,type:"trade_password",captcha:j.captcha});_({title:k("login.register.sendSucess"),icon:"none"}),I.value=!0,$.value=60,globalThis.inter=setInterval((()=>{console.log($.value),$.value-=1,0==$.value&&(clearInterval(globalThis.inter),I.value=!1)}),1e3)}catch(e){setTimeout((()=>{P()}),1e3)}},z=()=>j.amount>U.value?(_({title:k("user.without.numberNot")}),!1):0==j.name.length?(_({title:k("user.without.requireName")}),!1):void b(j).then((({data:e})=>{_({title:k("user.without.sucess"),icon:"none"})})),A=e=>{j.card_name=N.value[e.detail.value],j.card_number=""};return(e,a)=>{const l=d,t=x,s=g,o=w;return i(),c(l,{class:"page flex-column-start-center"},{default:u((()=>[p(l,{class:"card"},{default:u((()=>[p(l,{class:"title"},{default:u((()=>[m(h(f(k)("user.without.title")),1)])),_:1}),p(l,{class:"content flex-start-center-nowrap"},{default:u((()=>[p(l,{class:"unit"},{default:u((()=>[m("¥")])),_:1}),p(t,{class:"flex-1",modelValue:j.amount,"onUpdate:modelValue":a[0]||(a[0]=e=>j.amount=e),placeholder:U.value},null,8,["modelValue","placeholder"]),p(l,{class:"text",onClick:a[1]||(a[1]=e=>j.amount=U.value)},{default:u((()=>[m(h(f(k)("user.without.text")),1)])),_:1})])),_:1}),p(s,{mode:"selector",range:N.value,onChange:A},{default:u((()=>[p(l,{class:"flex-row-between-nowrap footer"},{default:u((()=>[p(l,{class:"label"},{default:u((()=>[m(h(f(k)("user.without.label")),1)])),_:1}),p(l,{class:"choose flex-start-center-nowrap"},{default:u((()=>[m(h((null==j?void 0:j.card_name)||f(k)("user.without.choose"))+" ",1),p(l,{class:"icon"})])),_:1})])),_:1})])),_:1},8,["range"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:u((()=>[p(t,{class:"text",modelValue:j.card_number,"onUpdate:modelValue":a[2]||(a[2]=e=>j.card_number=e),placeholder:f(k)("user.without.cardName"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:u((()=>[p(t,{class:"text",type:"text",modelValue:j.name,"onUpdate:modelValue":a[3]||(a[3]=e=>j.name=e),placeholder:f(k)("user.push.name"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:u((()=>[p(t,{class:"text",type:"text",modelValue:j.lianhang_code,"onUpdate:modelValue":a[4]||(a[4]=e=>j.lianhang_code=e),placeholder:f(k)("user.push.lianhang_code"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"flex-start-center-nowrap"},{default:u((()=>[p(l,{class:"line-input flex-start-center-nowrap",style:{width:"384rpx"}},{default:u((()=>[p(t,{name:"account",modelValue:j.captcha,"onUpdate:modelValue":a[5]||(a[5]=e=>j.captcha=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.captcha")},null,8,["modelValue","placeholder"])])),_:1}),p(o,{class:"verify",mode:"widthFix",src:C.value.img,onClick:P},null,8,["src"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:u((()=>[p(t,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.mobile"),disabled:"",modelValue:j.mobile,"onUpdate:modelValue":a[6]||(a[6]=e=>j.mobile=e)},null,8,["placeholder","modelValue"]),I.value?(i(),c(l,{key:1,class:"get-code get"},{default:u((()=>[m(h($.value)+"s",1)])),_:1})):(i(),c(l,{key:0,class:"get-code gray",onClick:q},{default:u((()=>[m(h(e.$t("login.register.getVerify")),1)])),_:1}))])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:u((()=>[p(t,{class:"text",type:"text",modelValue:j.verify,"onUpdate:modelValue":a[7]||(a[7]=e=>j.verify=e),placeholder:e.$t("login.forgetPassWord.verify"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:u((()=>[p(t,{class:"text",type:"password",modelValue:j.trade_password,"onUpdate:modelValue":a[8]||(a[8]=e=>j.trade_password=e),placeholder:f(k)("user.push.tradePassword"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"btn",onClick:z},{default:u((()=>[m(h(f(k)("user.push.confirm")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-5062532b"]]);export{k as default};
