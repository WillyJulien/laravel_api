<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ProfileRequest;
use Tests\TestCase;  // Assurez-vous que vous importez la bonne classe de TestCase
use Illuminate\Support\Facades\Validator;

class ProfileRequestTest extends TestCase
{
    /**
     * Test que la validation de la requête passe avec des données valides.
     */
    public function test_profile_request_validation_passes()
    {
        // Simuler une requête valide
        $data = [
            'name' => 'Julien',
            'firstname' => 'Teddy',
            'status' => 'active',
            'image' => 'test.jpg',
        ];

        // Récupérer les règles de validation depuis ProfileRequest
        $request = new ProfileRequest();
        $rules = $request->rules();

        // Utiliser le Validator de Laravel pour valider les données
        $validator = Validator::make($data, $rules);

        // Vérifier que la validation passe (pas d'erreurs)
        $this->assertFalse($validator->fails());
    }

    /**
     * Test que la validation échoue avec des données invalides.
     */
    public function test_profile_request_validation_fails()
    {
        // Simuler une requête invalide (par exemple, 'name' est vide)
        $data = [
            'name' => '',  // Champ 'name' vide, ce qui devrait échouer
            'firstname' => 'Teddy',
            'status' => 'active',
            'image' => 'test.jpg',
        ];

        // Récupérer les règles de validation depuis ProfileRequest
        $request = new ProfileRequest();
        $rules = $request->rules();

        // Utiliser le Validator de Laravel pour valider les données
        $validator = Validator::make($data, $rules);

        // Vérifier que la validation échoue
        $this->assertTrue($validator->fails());
    }
}
