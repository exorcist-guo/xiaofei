import{_ as e,u as a,r as l,f as t,v as s,y as o,z as n,A as r,a as u,w as c,i as d,o as i,b as p,d as m,t as h,E as f,B as _,x,I as g,D as w,k as v}from"./index-CN2O5Q8r.js";import{c as V,w as y,u as b,d as k}from"./user.CiuP7CP4.js";import{o as U}from"./uni-app.es.CqOQtvUa.js";import"./request.7RO1Qo_5.js";const I=e({__name:"without",setup(e){const{t:I}=a(),C=l(),j=l({img:"",key:""}),$=l(!1),N=l(0),P=t({name:"",card_name:"",card_number:"",amount:"",trade_password:"",name:"",lianhang_code:""}),T=l([]);s((()=>{C.value=o("userInfo").integral,z(),P.mobile=o("userInfo").mobile,q()})),U((()=>{amount.value=o("userInfo").integral}));const q=()=>{n({mask:!0}),V({type:"wit"}).then((({data:e})=>{j.value=e.url,r()}))},z=()=>{y().then((({data:e})=>{console.log(e),T.value=e.card_names,e.hasOwnProperty("collection_info")&&(P.card_name=e.collection_info.card_name,P.card_number=e.collection_info.card_number,P.name=e.collection_info.name)}))},A=async()=>{if(!P.captcha)return _({title:I("login.register.regCaptcha"),icon:"none"}),!1;try{const{data:e}=await b({key:j.value.key,type:"trade_password",captcha:P.captcha});_({title:I("login.register.sendSucess"),icon:"none"}),$.value=!0,N.value=60,globalThis.inter=setInterval((()=>{console.log(N.value),N.value-=1,0==N.value&&(clearInterval(globalThis.inter),$.value=!1)}),1e3)}catch(e){setTimeout((()=>{q()}),1e3)}},B=()=>P.amount>C.value?(_({title:I("user.without.numberNot")}),!1):0==P.name.length?(_({title:I("user.without.requireName")}),!1):void k(P).then((({data:e})=>{_({title:I("user.without.sucess"),icon:"none"}),x({url:"/pages/data/source"})})),D=e=>{P.card_name=T.value[e.detail.value],P.card_number=""};return(e,a)=>{const l=d,t=g,s=w,o=v;return i(),u(l,{class:"page flex-column-start-center"},{default:c((()=>[p(l,{class:"card"},{default:c((()=>[p(l,{class:"title"},{default:c((()=>[m(h(f(I)("user.without.title")),1)])),_:1}),p(l,{class:"content flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"unit"},{default:c((()=>[m("¥")])),_:1}),p(t,{class:"flex-1",modelValue:P.amount,"onUpdate:modelValue":a[0]||(a[0]=e=>P.amount=e),placeholder:C.value},null,8,["modelValue","placeholder"]),p(l,{class:"text",onClick:a[1]||(a[1]=e=>P.amount=C.value)},{default:c((()=>[m(h(f(I)("user.without.text")),1)])),_:1})])),_:1}),p(s,{mode:"selector",range:T.value,onChange:D},{default:c((()=>[p(l,{class:"flex-row-between-nowrap footer"},{default:c((()=>[p(l,{class:"label"},{default:c((()=>[m(h(f(I)("user.without.label")),1)])),_:1}),p(l,{class:"choose flex-start-center-nowrap"},{default:c((()=>[m(h((null==P?void 0:P.card_name)||f(I)("user.without.choose"))+" ",1),p(l,{class:"icon"})])),_:1})])),_:1})])),_:1},8,["range"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:c((()=>[p(t,{class:"text",modelValue:P.card_number,"onUpdate:modelValue":a[2]||(a[2]=e=>P.card_number=e),placeholder:f(I)("user.without.cardName"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:c((()=>[p(t,{class:"text",type:"text",modelValue:P.name,"onUpdate:modelValue":a[3]||(a[3]=e=>P.name=e),placeholder:f(I)("user.push.name"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:c((()=>[p(t,{class:"text",type:"text",modelValue:P.lianhang_code,"onUpdate:modelValue":a[4]||(a[4]=e=>P.lianhang_code=e),placeholder:f(I)("user.push.lianhang_code"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"flex-start-center-nowrap"},{default:c((()=>[p(l,{class:"line-input flex-start-center-nowrap",style:{width:"384rpx"}},{default:c((()=>[p(t,{name:"account",modelValue:P.captcha,"onUpdate:modelValue":a[5]||(a[5]=e=>P.captcha=e),class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.captcha")},null,8,["modelValue","placeholder"])])),_:1}),p(o,{class:"verify",mode:"widthFix",src:j.value.img,onClick:q},null,8,["src"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:c((()=>[p(t,{name:"account",class:"input flex-1",type:"text",maxlength:"11",placeholder:e.$t("login.register.mobile"),disabled:"",modelValue:P.mobile,"onUpdate:modelValue":a[6]||(a[6]=e=>P.mobile=e)},null,8,["placeholder","modelValue"]),$.value?(i(),u(l,{key:1,class:"get-code get"},{default:c((()=>[m(h(N.value)+"s",1)])),_:1})):(i(),u(l,{key:0,class:"get-code gray",onClick:A},{default:c((()=>[m(h(e.$t("login.register.getVerify")),1)])),_:1}))])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:c((()=>[p(t,{class:"text",type:"text",modelValue:P.verify,"onUpdate:modelValue":a[7]||(a[7]=e=>P.verify=e),placeholder:e.$t("login.forgetPassWord.verify"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"line-input flex-start-center-nowrap"},{default:c((()=>[p(t,{class:"text",type:"password",modelValue:P.trade_password,"onUpdate:modelValue":a[8]||(a[8]=e=>P.trade_password=e),placeholder:f(I)("user.push.tradePassword"),"placeholder-class":"text"},null,8,["modelValue","placeholder"])])),_:1}),p(l,{class:"btn",onClick:B},{default:c((()=>[m(h(f(I)("user.push.confirm")),1)])),_:1})])),_:1})}}},[["__scopeId","data-v-c67bbe58"]]);export{I as default};
