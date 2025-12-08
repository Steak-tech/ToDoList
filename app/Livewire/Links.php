<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // Pour faire les requêtes
use Illuminate\Support\Str;

class Links extends Component
{
    public $newUrl = '';

    public function addLink()
    {
        $this->validate(['newUrl' => 'required|url']);

        // 1. On tente de récupérer les infos de la page
        try {
            $response = Http::timeout(5)->get($this->newUrl);
            $html = $response->body();

            // 2. On cherche les balises <meta property="og:..."> avec des Regex simples
            // (Pour une prod très robuste, on utiliserait une librairie comme "embed/embed", mais ça suffit ici)
            $title = $this->getMetaContent($html, 'og:title') ?? $this->getTitleTag($html) ?? $this->newUrl;
            $description = $this->getMetaContent($html, 'og:description');
            $image = $this->getMetaContent($html, 'og:image');

        } catch (\Exception $e) {
            // Si le site bloque ou ne répond pas, on met des valeurs par défaut
            $title = $this->newUrl;
            $description = "Lien ajouté manuellement.";
            $image = null;
        }

        // 3. Sauvegarde
        Link::create([
            'user_id' => Auth::id(),
            'url' => $this->newUrl,
            'title' => Str::limit($title, 50),
            'description' => Str::limit($description, 100),
            'image' => $image,
        ]);

        $this->reset('newUrl');
        session()->flash('message', 'Lien ajouté avec succès !');
    }

    public function deleteLink($id)
    {
        Link::where('id', $id)->where('user_id', Auth::id())->delete();
    }

    // Petits helpers pour extraire les données du HTML
    private function getMetaContent($html, $property)
    {
        preg_match('/<meta property="' . $property . '" content="(.*?)"/', $html, $matches);
        return $matches[1] ?? null;
    }

    private function getTitleTag($html)
    {
        preg_match('/<title>(.*?)<\/title>/', $html, $matches);
        return $matches[1] ?? null;
    }

    public function render()
    {
        return view('livewire.links', [
            'links' => Link::where('user_id', Auth::id())->latest()->get()
        ]);
    }
}