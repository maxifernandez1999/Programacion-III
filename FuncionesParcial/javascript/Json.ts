//en el namespace Main poner el reference path
/// //<reference path="Json.ts" />
class Json {

    private Json : any;

    public constructor(json:any) {
        this.Json = json;
    }

    public JSONParse = (cadena:string):any => {
        var cadenaSplit:string[] = cadena.split("");
        if(cadenaSplit[0] == "{" || cadenaSplit[0] == "["){
            var JsonParse:any = JSON.parse(cadena);
            return JsonParse;
        }
    };
    public JSONStringify = (objJSON:any):string => {
        var JSONtoString: string = JSON.stringify(objJSON);
        return JSONtoString;
    };
}