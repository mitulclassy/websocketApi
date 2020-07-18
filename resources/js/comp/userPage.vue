<template>
<div>

    <div class="container-fluid">

        <div class="row pt-5">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>

                        <tr>
                            <th>Name of User: </th>
                            <td colspan="2">{{currentUser.name}}</td>
                        </tr>

                        <tr>
                            <th>Email: </th>
                            <td colspan="2">{{currentUser.email}}</td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-if="!matchJoin">
                            <th>Host a Match</th>
                            <td colspan="2">
                                <div class="input-group "  v-if="false">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Select User</span>
                                    </div>

                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option v-for="(userName,userId) in  allUser" :value="userId">{{userName}}</option>

                                    </select>

                                </div>

                                <div>
                                    <div  v-if="!matchHost" class="btn btn-info col mt-2" v-on:click="hostGame()">Host A Match</div>
                                    <div  v-else class="bg-success col mt-2 text-center" >Game Code : <h3>{{matchId}}</h3> </div>

                                </div>
                            </td>
                        </tr>
                        <tr v-if="!matchHost ">
                            <th>Join a Match</th>
                            <td colspan="2">
                                <div v-if="!matchJoin" class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Match ID</span>
                                    </div>

                                    <input class="form-control" type="text" v-model="matchId">

                                    </input>

                                </div>

                                <div  v-if="!matchJoin">
                                    <div class="btn btn-info col mt-2" v-on:click="joinGame()">Join Match</div>

                                </div>

                                <div  v-else>
                                    <div class="btn btn-info col mt-2" >Match Joined : {{matchId}}</div>

                                </div>


                            </td>
                        </tr>
                        <tr v-if="matchJoined"  >
                            <th>Take a move</th>
                            <td colspan="2">


                                <div class="row">
                                    <div class="btn btn-info col  ml-2 mt-2 mr-2" v-on:click="move1()">Move 1</div>
                                    <div class="btn btn-info col mt-2  mr-2" v-on:click="move2()">Move 2</div>
                                    <div class="btn btn-info col mt-2  mr-2" v-on:click="move3()">Move 3</div>

                                </div>
                            </td>
                        </tr>

                        <tr v-if="matchJoined">
                            <th>Match Joined Details</th>
                            <td>
                            <table class="table">
                                <tr> <td colspan="2">You  </td> </tr>
                                <tr>
                                    <td>Name</td>
                                    <th>{{currentUser.name}}</th>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <th>{{currentUser.email}}</th>
                                </tr>
                                <tr v-if="hostMove.length > 0 ">
                                    <td colspan="2">
                                        Moves
                                    </td>

                                </tr>
                                <tr v-if="hostMove.length > 0 " v-for="mv in hostMove">
                                    <td colspan="2"> {{ mv  }}</td>

                                </tr>


                            </table>
                            </td>

                            <td >
                            <h4>VS</h4>
                            </td>
                            <td>
                                <table class="table" v-if="matchJoinedData.hasOwnProperty('userClientData')">
                                    <tr> <td colspan="2"> Other Player  </td> </tr>
                                    <tr>
                                        <td>Name</td>
                                        <th> {{ matchJoinedData.userClientData.name }}</th>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <th> {{ matchJoinedData.userClientData.email }}</th>
                                    </tr>

                                    <tr v-if="clientMove.length > 0 ">
                                        <td colspan="2">
                                            Moves
                                        </td>

                                    </tr>
                                    <tr v-if="clientMove.length > 0 " v-for="mv in clientMove">
                                        <td colspan="2"> {{ mv  }}</td>

                                    </tr>
                                </table>
                                <table class="table" v-if="matchJoinedData.hasOwnProperty('userHostData')">
                                    <tr> <td colspan="2"> Other Player  </td> </tr>
                                    <tr>
                                        <td>Name</td>
                                        <th> {{ matchJoinedData.userHostData.name }}</th>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <th> {{ matchJoinedData.userHostData.email }}</th>
                                    </tr>
                                    <tr v-if="clientMove.length > 0 ">
                                        <td colspan="2">
                                            Moves
                                        </td>

                                    </tr>
                                    <tr v-if="clientMove.length > 0 " v-for="mv in clientMove">
                                        <td colspan="2"> {{ mv  }}</td>

                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr  v-if="matchJoined">
                            <th>
                                End game
                            </th>
                            <td>
                                <div class="btn btn-danger col mt-2" v-on:click="endGame()">End Game</div>
                            </td>

                        </tr>

                        </tbody>
                    </table>

                </div>
        </div>

    </div>


</div>
</template>

<script>
    export default {
        name: "userpage",
        props:{
            'msData':{
                type: Object,
                required: false
            }
        },
        data(){
          return {
              currentUser:{},
              allUser:{},
              paths:{},
              matchHost:false,
              matchId:'test',
              matchJoin:false,

              matchJoined:false,
              matchJoinedData:{},
              hostMove:[],
              clientMove:[]

          }  ;
        },
        mounted() {
            this.currentUser=this.msData.user;
            this.allUser=this.msData.allUser;
            this.paths=this.msData.paths;
            var th=this;


        },
        methods:{
            hostGame(){

                if(!this.matchHost){
                    var  url=this.paths.hostGame;
                    var th=this;
                    th.matchHost=false;
                    axios.get(url).then(function(res){
                        th.matchHost=true;
                        th.matchId=res.data.matchId;
                        var channel='match-'+th.matchId;
                        Echo.channel(channel)
                            .listen('.matchStarted' ,function (e) {
                                console.log(e)


                                if(e.data.hasOwnProperty('userClient')){
                                    th.matchJoinedData=e.data;
                                    th.matchJoined=true;
                                    var url2=th.paths.startNotifyForOther.replace('ChangeMatchId',th.matchId);
                                    axios.get(url2);
                                }else if (e.data.hasOwnProperty('userHost')){

                                }



                            }) .listen('.GameBrodcaster' ,function (e) {
                                console.log(e)
                            })
                            .listen('.matchEnded',function () {

                            })
                            .listen('.moveTaken',function (e) {
                                if(e.data.hasOwnProperty('userHost'))th.hostMove.push(e.data.move);
                                if(e.data.hasOwnProperty('userClient'))th.clientMove.push(e.data.move);
                            })
                            .listen('.TestTriggered', (e) => {
                                console.log("triggers");
                            });

                    })
                        .catch(function(e){

                        });

                }


            },
            joinGame(){
                var  url=this.paths.joinGame.replace('ChangeMatchId',this.matchId);
                var th=this;
                th.matchJoin=false;
                axios.get(url).then(function(res){
                    th.matchJoin=true;
                    var channel='match-'+th.matchId;
                    Echo.channel(channel).listen('.matchStarted' ,function (e) {

                            if(e.data.hasOwnProperty('userHost')){
                                th.matchJoinedData=e.data;
                                th.matchJoined=true;



                            }
                        })
                        .listen('.GameBrodcaster' ,function (e) {
                        console.log(e)
                    })
                        .listen('.matchEnded',function () {

                        })
                        .listen('.moveTaken',function (e) {

                            if(e.data.hasOwnProperty('userClient'))th.hostMove.push(e.data.move);
                            if(e.data.hasOwnProperty('userHost'))th.clientMove.push(e.data.move);

                        })
                        .listen('.TestTriggered', (e) => {
                            console.log("triggers");
                        });

                })
                    .catch(function(e){

                    });
            },
            move1(){
                var url =this.paths.moveGame.replace('ChangeMatchId',this.matchId);;
                var data= {
                    move:'move1'
                };
                axios.post(url,data);

            },
            move2(){
                var url =this.paths.moveGame.replace('ChangeMatchId',this.matchId);;
                var data= {
                    move:'move2'
                };
                axios.post(url,data);
            },
            move3(){
                var url =this.paths.moveGame.replace('ChangeMatchId',this.matchId);;
                var data= {
                    move:'move3'
                };
                axios.post(url,data);
            },
            endGame(){
                var url =this.paths.endGame.replace('ChangeMatchId',this.matchId);;
                axios.get(url);
            }
        }
    }
</script>

<style scoped>

</style>
