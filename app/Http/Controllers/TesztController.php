<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Name;
use App\Models\Family;

class TesztController extends Controller
{
    public function teszt()
{
    $names = [
        'Traza', 'Beep', 'Zsó', 'Musla',
        'D3n', 'Nekokota', 'Nhilerion'
    ];
    $randomNameKey = array_rand($names, 1);
    $randomName = $names[$randomNameKey];

    return view('pages.teszt', compact('randomName'));
}

public function names()
{
    $names = Name::all();
    $families = Family::all();
    return view('pages.names', compact('names', 'families'));
}
    public function familyCreate($name)
    {
        $familyRecord = new Family();
        $familyRecord->surname = $name;
        $familyRecord->save();

        return $familyRecord->id;
    }

    public function namesCreate($family, $name)
    {
        $nameRecord = new Name();
        $nameRecord->name = $name;
        $nameRecord->family_id = $family;
        $nameRecord->save();

        return $nameRecord->id;
    }

    public function deleteName(Request $request)
{
    $name = Name::find($request->input('id'));
    $name->delete();

    return "ok";
}
public function manageSurname()
{
    $names = Family::all();
    return view('pages.surname', compact('names'));
}

public function deleteSurname(Request $request)
{
    $name = Family::find($request->input('id'));
    $name->delete();

    return "ok";
}

public function newSurname(Request $request)
{
    $familyRecord = new Family();
    $familyRecord->surname = $request->input('inputFamily');
    $familyRecord->save();

    return redirect("/names/manage/surname");
}


public function newName(Request $request)
{
    $name = new Name();
    $name->family_id = $request->input('inputFamily');
    $name->name = $request->input('inputName');
    $name->save();

    return redirect("/names");
}
}
