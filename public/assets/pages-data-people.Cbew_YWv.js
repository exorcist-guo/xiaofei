import{_ as a,u as e,f as t,p as s,g as l,a as o,w as d,i as r,o as c,b as n,d as u,t as p,h as f,j as _,F as i,S as m}from"./index-DrfAeCf7.js";import{t as w}from"./user.DMZCLkX_.js";import"./request.BK0VuoJ8.js";const b=a({__name:"people",setup(a){const{t:b}=e(),g=t({page:1,data:[],count:"0"});s((()=>{l({title:b("data.people.nTitle")}),x()}));const x=()=>{w({page:g.page}).then((({data:a})=>{g.data=[...g.data,...a.list],g.count=a.count,console.log(a)}))};return(a,e)=>{const t=r,s=m;return c(),o(t,{class:"page"},{default:d((()=>[n(t,{class:"banner"},{default:d((()=>[n(t,{class:"before"},{default:d((()=>[u(p(a.$t("data.people.before")),1)])),_:1}),n(t,{class:"nums"},{default:d((()=>[u(p(g.count),1)])),_:1})])),_:1}),n(t,{class:"title flex-row-between-nowrap"},{default:d((()=>[n(t,{class:"tt"},{default:d((()=>[u(p(a.$t("data.people.tt")),1)])),_:1}),n(t,{class:"flex-start-center-nowrap more"})])),_:1}),n(s,{class:"scroll","scroll-y":"",onScrolltolower:x},{default:d((()=>[(c(!0),f(i,null,_(g.data,(e=>(c(),o(t,{class:"item flex-row-between-nowrap",key:e.id},{default:d((()=>[n(t,null,{default:d((()=>[n(t,{class:"type"},{default:d((()=>[u(p(e.number),1)])),_:2},1024),n(t,{class:"name"},{default:d((()=>[u(p(a.$t("data.people.name")),1)])),_:1}),n(t,{class:"date"},{default:d((()=>[u(p(e.created_at),1)])),_:2},1024)])),_:2},1024),n(t,{class:"price"},{default:d((()=>[u(p(e.pv),1)])),_:2},1024)])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-6bdce2f6"]]);export{b as default};
