import{_ as a,r as e,u as s,g as t,a as l,w as u,i as o,o as n,b as d,M as i,e as r,h as c,j as f,F as _,S as p,d as m,t as q,m as b}from"./index-BLfjTknn.js";import{a as w}from"./uni-app.es.B9ooW2kF.js";import{a as x}from"./question.DaMozVHN.js";import"./request.CzuKqAxG.js";const y=a({__name:"list",setup(a){const y=e([]),v=e(1),{t:j}=s();w((()=>{t({title:j("question.list.nTitle")}),$()}));const $=()=>{x({page:v.value}).then((({data:a})=>{v.value+=1,y.value=[...y.value,...a]}))};return(a,e)=>{const s=o,t=b,w=p;return n(),l(s,{class:"page"},{default:u((()=>[d(w,{class:"scroll","scroll-y":"",onScrolltolower:$},{default:u((()=>[y.value.length?r("",!0):(n(),l(i,{key:0})),(n(!0),c(_,null,f(y.value,(e=>(n(),l(s,{class:"item",key:e},{default:u((()=>[d(s,{class:"form-item flex-row-between-nowrap"},{default:u((()=>[d(s,{class:"label"},{default:u((()=>[m(q(a.$t("question.index.tt1")),1)])),_:1}),d(s,{class:"input blue"},{default:u((()=>[m(q(e.type_name),1)])),_:2},1024)])),_:2},1024),d(s,{class:"form-item flex-row-between-nowrap"},{default:u((()=>[d(s,{class:"label"},{default:u((()=>[m(q(a.$t("question.list.date")),1)])),_:1}),d(s,{class:"input date"},{default:u((()=>[m(q(e.created_at),1)])),_:2},1024)])),_:2},1024),d(s,{class:"label"},{default:u((()=>[m(q(a.$t("question.index.tt2")),1)])),_:1}),d(s,{class:"context"},{default:u((()=>[d(t,{class:""},{default:u((()=>[m(q(e.question),1)])),_:2},1024)])),_:2},1024),d(s,{class:"label"},{default:u((()=>[m(q(a.$t("question.list.ans")),1)])),_:1}),d(s,{class:"context"},{default:u((()=>[e.reply?(n(),l(t,{key:0,class:""},{default:u((()=>[m(q(e.reply),1)])),_:2},1024)):(n(),l(t,{key:1,class:"placeholder"},{default:u((()=>[m(q(a.$t("question.list.noAns")),1)])),_:1}))])),_:2},1024)])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-02894fd6"]]);export{y as default};
