import{_ as e,r as a,u as s,g as t,a as l,w as o,i as u,o as n,b as c,L as d,e as i,h as r,j as f,F as _,S as p,d as m,t as q,m as b}from"./index-JN3MqxNP.js";import{a as w}from"./uni-app.es.BgL2matC.js";import{a as x}from"./question.CeUOfHgH.js";import"./request.Bbgpknwy.js";const y=e({__name:"list",setup(e){const y=a([]),v=a(1),{t:g}=s();w((()=>{t({title:g("question.list.nTitle")}),j()}));const j=()=>{x({page:1}).then((({data:e})=>{console.log(e),v.value+=1,y.value=[...y.value,...e]}))};return(e,a)=>{const s=u,t=b,w=p;return n(),l(s,{class:"page"},{default:o((()=>[c(w,{class:"scroll","scroll-y":"",onScrolltolower:j},{default:o((()=>[y.value.length?i("",!0):(n(),l(d,{key:0})),(n(!0),r(_,null,f(y.value,(a=>(n(),l(s,{class:"item",key:a},{default:o((()=>[c(s,{class:"form-item flex-row-between-nowrap"},{default:o((()=>[c(s,{class:"label"},{default:o((()=>[m(q(e.$t("question.index.tt1")),1)])),_:1}),c(s,{class:"input blue"},{default:o((()=>[m(q(a.type_name),1)])),_:2},1024)])),_:2},1024),c(s,{class:"form-item flex-row-between-nowrap"},{default:o((()=>[c(s,{class:"label"},{default:o((()=>[m(q(e.$t("question.list.date")),1)])),_:1}),c(s,{class:"input date"},{default:o((()=>[m(q(a.created_at),1)])),_:2},1024)])),_:2},1024),c(s,{class:"label"},{default:o((()=>[m(q(e.$t("question.index.tt2")),1)])),_:1}),c(s,{class:"context"},{default:o((()=>[c(t,{class:""},{default:o((()=>[m(q(a.question),1)])),_:2},1024)])),_:2},1024),c(s,{class:"label"},{default:o((()=>[m(q(e.$t("question.list.ans")),1)])),_:1}),c(s,{class:"context"},{default:o((()=>[a.reply?(n(),l(t,{key:0,class:""},{default:o((()=>[m(q(a.reply),1)])),_:2},1024)):(n(),l(t,{key:1,class:"placeholder"},{default:o((()=>[m(q(e.$t("question.list.noAns")),1)])),_:1}))])),_:2},1024)])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-4632ebd3"]]);export{y as default};
