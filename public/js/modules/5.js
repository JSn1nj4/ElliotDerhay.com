webpackJsonp([5],{Drtj:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"flex flex-row relative"},[n("div",{staticClass:"text-grey text-center flex-none github-activity-icon",class:t.icon,staticStyle:{width:"2rem","font-size":"22px"}}),t._v(" "),n("div",{staticClass:"pl-4 flex-grow relative"},[n("p",{staticClass:"text-grey"},[t._v("\n      about "+t._s(t.formattedDate)+"\n    ")]),t._v(" "),n("p",{staticClass:"font-white mt-1 text-sm"},[n("strong",[n("a",{staticClass:"no-underline",attrs:{href:t.profileUrl,target:"_blank"}},[t._v("\n          "+t._s(t.event.actor.display_login)+"\n        ")]),t._v("\n\n        "+t._s(t.action)+"\n\n        "),n("a",{staticClass:"no-underline text-sea-green",attrs:{href:t.event.payload.comment.html_url,target:"_blank"}},[t._v("\n          "+t._s(t.issueNumberString)+"\n        ")]),t._v("\n\n        "+t._s(t.preposition)+"\n\n        "),n("a",{staticClass:"no-underline",attrs:{href:t.repoUrl,target:"_blank"}},[t._v("\n          "+t._s(t.event.repo.name)+"\n        ")])])]),t._v(" "),n("p",{staticClass:"font-grey align-middle mt-2"},[n("a",{attrs:{href:t.event.payload.comment.user.html_url}},[n("img",{staticClass:"align-bottom",attrs:{width:"18",height:"18",src:t.event.payload.comment.user.avatar_url}})]),t._v("\n\n      "+t._s(t.issueComment)+"\n    ")])])])},staticRenderFns:[]}},p8aZ:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=n("pRWI");e.default={name:"git-hub-issue-comment-event",mixins:[a.a],data:function(){return{icon:"fas fa-comment",action:"commented on",preposition:"at"}},mounted:function(){"deleted"==this.event.payload.action&&(this.action="deleted comment from",this.icon="fas fa-comment-slash")}}},pRWI:function(t,e,n){"use strict";var a=n("PJh5"),r=n.n(a),s=n("ycsb"),i=n.n(s);e.a={name:"git-hub-activity-mixin",components:{Card:i.a},props:{event:Object},data:function(){return{baseLink:"https://github.com",tmpAvatarUrl:"https://pbs.twimg.com/profile_images/936031034168172545/TwJzUf5p_normal.jpg"}},computed:{formattedDate:function(){return r()(this.event.created_at).fromNow()},profileUrl:function(){return"".concat(this.baseLink,"/").concat(this.event.actor.login)},repoUrl:function(){return"".concat(this.baseLink,"/").concat(this.event.repo.name)},branchName:function(){return this.event.payload.ref.replace("refs/heads/","")},branchUrl:function(){return"".concat(this.repoUrl,"/tree/").concat(this.branchName)},branchCommitsUrl:function(){return"".concat(this.repoUrl,"/commits/").concat(this.branchName)},displayCommits:function(){var t=this.event.payload.commits;return t.length>4?t.slice(0,4):t},extraCommitsCount:function(){var t=this.event.payload.commits;return t.length>4?t.length-4:0},issueNumberString:function(){return"Issue #".concat(this.event.payload.issue.number)},issueComment:function(){var t=this.event.payload.comment.body;return t.length>280?t.slice(0,280).slice(0,t.lastIndexOf(" "))+"...":t}},methods:{shortMsg:function(t){var e=t.indexOf("\n");return e>=0?t.slice(0,e):t},shortHash:function(t){return t.slice(0,6)},commitUrl:function(t){return"".concat(this.repoUrl,"/commit/").concat(t)}}}},pp7L:function(t,e,n){var a=n("VU/8")(n("p8aZ"),n("Drtj"),!1,null,null,null);t.exports=a.exports}});