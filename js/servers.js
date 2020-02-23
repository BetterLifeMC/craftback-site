servers =
{
    "servers" : [
        {
            "fingerprint":"1234567890" , "hostname":"games01-serv", "port":"8080"
        }
    ]
}

var serverPorts = [];
var serverHostnames = [];
var serverFingerPrints = [];

for (var i = 0; i < servers["servers"].length; i++) {
    serverPorts.push(servers["servers"][i].port);
    serverHostnames.push(servers["servers"][i].hostname);
    serverFingerPrints.push(servers["servers"][i].fingerprint);
}
