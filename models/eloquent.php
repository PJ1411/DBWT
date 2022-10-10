<?php
//namespace App\Models;
class Bewertung extends Illuminate\Database\Eloquent\Model{
    protected $primaryKey = 'id';
    protected $table = 'bewertung';
    protected $fillable =['hervorgehoben','benutzerID', 'gerichteID','bemerkung', 'sterne_bewertung', 'zeitpunkt'];

}

class Gericht extends Illuminate\Database\Eloquent\Model{
    protected $primaryKey = 'id';
    protected $table = 'gericht';
    protected $attributes = ['vegetarisch' => 0, 'vegan' => 0];
    protected $fillable =['id','name','beschreibung','erfasst_am','vegetarisch','vegan','preis_intern','preis_extern','bildname'];

    public $timestamps = false;

    function getPreisInternAttribute($preis){
        return number_format((float)$preis, 2, '.', '');
    }
    function getPreisExternAttribute($preis){
        return number_format((float)$preis, 2, '.', '');
    }
    function setVeganAttribute($value)
    {
        $val = trim($value);
        $wert = strtolower($val);
        if ($wert == "yes" || $wert == "ja") {
            $this->attributes['vegan'] = true;
        } else if ($wert == "no" || $wert == "nein") {
            $this->attributes['vegan'] = false;
        }
    }
    function setVegetarischAttribute($value)
    {
        $val = trim($value);
        $wert = strtolower($val);
        if ($wert == "yes" || $wert == "ja") {
            $this->attributes['vegetarisch'] = true;
        } else if ($wert == "no" || $wert == "nein") {
            $this->attributes['vegetarisch'] = false;
        }
    }
}
function gerichtSpeicher(){
    $name = $_POST['gericht'];
    $beschreibung = $_POST['beschreibung'];
    $vegetarisch = $_POST['vegetarisch'];
    $vegan = $_POST['vegan'];
    $intern = $_POST['preis_intern'];
    $extern = $_POST['preis_extern'];
    if(isset($_POST['bildname']))
        $bildname = $_POST['bildname'];
    else $bildname = null;

    $id =count(Gericht::query()->select('id')->get());
    $gericht = new Gericht;
    $gericht->name = $name;
    $gericht->beschreibung = $beschreibung;
    $gericht->erfasst_am = date('Y-m-d');
    $gericht->vegetarisch = $vegetarisch;
    $gericht->vegan = $vegan;
    $gericht->preis_intern= $intern;
    $gericht->preis_extern = $extern;
    $gericht->bildname = $bildname;
    $gericht->id = $id+2;
    $gericht->save();
}
class Benutzer extends Illuminate\Database\Eloquent\Model{
    protected $primaryKey= 'id';
    protected $table = 'benutzer';
}

function getGericht_ORM($gerichtID){
    $result = Gericht::query()->select()->where('id','=',$gerichtID);
    session_start();
    $_SESSION['gerichtID'] = $result->first(['id']);
    return $result->first();
}

function aktHervorhebung_ORM(){
    $bewertungen = Bewertung::query()->select('id','hervorgehoben')->where('hervorgehoben','=',0);
    foreach ($bewertungen->get() as $row){
        $id = $row->id;
        if(isset($_POST[$id.'hervorheben'])){
            Bewertung::query()->updateOrInsert(['id'=>$id],['hervorgehoben' => true]);
        }
    }
}

function aktAbwaelhen_ORM(){
    $bewertungen = Bewertung::query()->select('id','hervorgehoben')->where('hervorgehoben','=',1);
    foreach ($bewertungen->get() as $row){
        $id = $row->id;
        if(isset($_POST[$id.'abwaehlen'])){
            Bewertung::query()->updateOrInsert(['id'=>$id],['hervorgehoben' => false]);
        }
    }
}

function bewertungLoeschen_ORM(){

    session_start();
    $email = $_SESSION['benutzername'];
    $idQuery = Benutzer::query()->select('id')->where('email','=',$email)->first();
    $id = $idQuery->id;
    $bewertungen = Bewertung::query()->select()->where('benutzerID','=',$id);

    foreach ($bewertungen->get() as $row)
    {
        if(isset($_POST[$row['id'].'Loeschen']))
        {
            $id = $row['id'];
            Bewertung::query()->where('id','=',$id)->delete();
        }
    }
}

function bewVer_ORM(){
    if(isset($_POST['bemerkung'])){
        if(isset($_POST['bewertung'])){
            $bewertung = $_POST['bewertung'];
            $bemerkung = $_POST['bemerkung'];
            if(strlen($bemerkung)>4){
                session_start();
                $gerichtID = $_SESSION['gerichtID'];
                $email = $_SESSION['benutzername'];
                $bID = Benutzer::query()->select('id')->where('email','=',$email)->first();
                $benutzerID =$bID->id;
                $mytime = Carbon\Carbon::now();
                $eintrag = Bewertung::query()->create(['hervorgehoben'=>0,'benutzerID'=>$benutzerID, 'gerichteID'=>$gerichtID,'bemerkung'=>$bemerkung, 'sterne_bewertung'=>$bewertung, 'zeitpunkt'=>$mytime]);
                $eintrag->save();
                return true;
            } else false;
        }else false;
    }else false;
}

function db_gerichte_mit_allergene_ORM(){
    return Gericht::query()->leftJoin('gericht_hat_allergen','id','=','gericht_id')->select('id', 'name', 'preis_intern', 'preis_extern', 'bildname')->selectRaw( 'group_concat(code) as code')->groupBy('id')->orderBy('name','asc')->get();
}