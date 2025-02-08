import{_ as a,u as e,f as s,g as t,s as l,a as r,w as n,i as o,o as c,b as d,d as p,t as u,h as m,j as A,F as f,k as v,S as b}from"./index-Cu6ZRL8P.js";import{p as i,a as w}from"./data.DmigH0fX.js";import{o as g}from"./uni-app.es.HQMdbc2N.js";import"./request.Cdi9Y7TV.js";const B="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIYAAAAoCAYAAAA7b4IPAAAAAXNSR0IArs4c6QAABTRJREFUeF7tmterXFUUxn+fvfdesStW7BXbg0bBt6gPIuiLKEZE9MU38UHQP0AUxeCDYlQsGAtiLIEoWIIYe++9p2qS5f50z814c2bumcmMGefs9XJzM/vsWevb3/5WOVcUKwhUIKCCSkGgCoFCjMKLSgQKMQoxCjEKB+ojsJpiRMS1wGxJb9ffpqwcNwT+RYyI2Bl4HdgOmAfcDcyS9Mu4BV7i6Y5AlWKcDJwInJt/rgCeBO4DHpf0awF1/BGoIsZpbWFvAZwJnAEcDPwJPGeCAE9Jemf8IWpmhFMRox2V7YGWmhwGbAB8nUjzAvAS8IrTkKTfe4EyIrYE9ge2AgL4AnhfkpWq2FpCoBditLu4EWByHAEcmg/WRFkJfOmDBT4HvgF+BhYDPuj1AavQjsBewCHA7sBkP1zTPJHW3Spp7lrCZqBfGxHrARtadSX9MdDNh7BZv8SY7IqD3hPYB9gD2BWwwmwNbJ4BWTenIpPEB2/SfAp8lH/+BqyTSWPSOX15z9nADEkf9xt/RLiY3glYbsJKWtTvXlM9FxGO4Tjg9OT7McCBwG7Apm0XwN/v+N8DFmTFnSvp+6n2H8bnETEtndFNyY+zJdmv1W4qEdFeYwzDj172PBW4HNgEuErSzLoPR4TV6DLgvEzW1qNWrreS2j0MzJRkYq6xRcSRieCXANMzuX34rsE+Ab4DnGKtFL5Eviwmq9VyX2CHrLavAQ+leu5+SVbdoVpEbJOwvRm4NNWSVubpkuzryBPDPpoUM8zmlLLuSSBf0a0zigjfzlvS4Z+fyPRTLpZ9K38ArFr+3Ip0ErBxSoUPpv+/UZLX9GQR4dRwYdr7SuDo5OePwDMZZJPPqbWOWV1NLCvN8YBT9YvJ1zvyuGCgChcRjtsX7vqs5rcD90pynfi3VaUS39JRNHdH1+Q0dJ3bZ0kTwEfEtvmAPKDzzbzTnVNOH1XxGPyz8sG65pmV8LihTqcVEbtkNbIi+ba/DDySU8KaFs3264Q8LjBZFuZRgccFz0tyOuzLIsKp2apmUhgvd5d35Qu0UNKr3YjhzsPmDqGSPB28mrx+GM/7EK7O3dFX+WZaoi3HVgB/p6XYKceA1vHf0n5OqnUuzvL+KHAbMEeS2/N/wIiwcjkXX5QPzZ95vvNALrSHEb8HjvbNaul/W5HmZBU0GRdIWtKJJRGxWVYin6nnUlajZbmw90Vwo9CyRZLmdyOG5WzUzQWdb/sBOR18C5jtT2dF6cd/d0w+hAvSxHfvTKw3836uB1yzuPN6N6WNxzK4A5X4KZx2zKekW35sUpCDcq1ixfQF8djABb3VxER36+8GwGRyVrCfJpJHC88CVWRaLOmNbsQ4qh9Ux+wZE84dhQnibsKq5A7C85rPRiBWE3S/7J8J4LTggtY1lFOZ/bW6eGRgvz+sUe8skeS6qFpmI+LwEQi8uPDfI7BUktWwIzE8+m7lSy+q+zcb7Tm2PL/qYP8v+C2T9EE3Yng8Xax5CHgiOzFErGpXnVeLNQ8BE8M1ScdU4pF2seYhsFySO5yOxHCL08naFWZyHdH+e3m+GoFRxm+FJLf9HYnh8Wyx5iGwUpJb3I7E8BvRYs1DwMSY+Ou8quLTg5JizUMgJLVeI1S+RPNLnF7NBKtTY3SrPcrzvaK+av1A8Je0tFsq8ay9WAMRaH9zW3cq10CYmh1yIUazz79j9IUYhRiVCBRiFGIUYhQO1EegKEZ9rBq1shCjUcddP9hCjPpYNWplIUajjrt+sIUY9bFq1MpCjEYdd/1g/wLQVX04vVWBmgAAAABJRU5ErkJggg==",E=a({__name:"turnover",setup(a){const{t:E}=e(),S=s({page:1,data:[],month_pv:"",last_month_pv:"",pv:""});g((()=>{t({title:E("data.turnover.nTitle")});for(let a of[1,2,3])console.log(a),l({index:a-1,text:E(`menu.menu${a}`)});W(),z()}));const W=()=>{i().then((({data:a})=>{console.log(a),S.month_pv=Number(a.month_pv),S.last_month_pv=Number(a.last_month_pv),S.pv=Number(a.pv)}))},z=()=>{w({page:S.page}).then((({data:a})=>{S.page+=1,S.data=[...S.data,...a]}))};return(a,e)=>{const s=o,t=v,l=b;return c(),r(s,{class:"page"},{default:n((()=>[d(s,{class:"banner flex-row-between-nowrap"},{default:n((()=>[d(s,{class:"item flex-1"},{default:n((()=>[d(s,{class:"label"},{default:n((()=>[p(u(a.$t("data.turnover.lbel1")),1)])),_:1}),d(s,{class:"nums"},{default:n((()=>[p(u(S.month_pv),1)])),_:1}),d(t,{class:"icon",src:B})])),_:1}),d(s,{class:"item flex-1"},{default:n((()=>[d(s,{class:"label"},{default:n((()=>[p(u(a.$t("data.turnover.lbel2")),1)])),_:1}),d(s,{class:"nums"},{default:n((()=>[p(u(S.last_month_pv),1)])),_:1}),d(t,{class:"icon",src:B})])),_:1}),d(s,{class:"item flex-1"},{default:n((()=>[d(s,{class:"label"},{default:n((()=>[p(u(a.$t("data.turnover.lbel3")),1)])),_:1}),d(s,{class:"nums"},{default:n((()=>[p(u(S.pv),1)])),_:1}),d(t,{class:"icon",src:B})])),_:1})])),_:1}),d(s,{class:"title flex-row-between-nowrap"},{default:n((()=>[d(s,{class:"tt"},{default:n((()=>[p(u(a.$t("data.source.log")),1)])),_:1}),d(s,{class:"flex-start-center-nowrap more"})])),_:1}),d(l,{class:"scroll","scroll-y":"",onScrolltolower:W},{default:n((()=>[(c(!0),m(f,null,A(S.data,(a=>(c(),r(s,{class:"item flex-row-between-nowrap",key:a.id},{default:n((()=>[d(s,null,{default:n((()=>[d(s,{class:"type"},{default:n((()=>[p(u(a.remark),1)])),_:2},1024),d(s,{class:"name"},{default:n((()=>[p(u(a.action_name),1)])),_:2},1024),d(s,{class:"date"},{default:n((()=>[p(u(a.created_at),1)])),_:2},1024)])),_:2},1024),d(s,{class:"price"},{default:n((()=>[p("+"+u(a.amount),1)])),_:2},1024)])),_:2},1024)))),128))])),_:1})])),_:1})}}},[["__scopeId","data-v-bcee1c3a"]]);export{E as default};
