<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RyanChandler\FilamentNavigation\Models\Navigation;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Navigation::create([
            'name' => 'Main Menu',
            'handle' => 'main-menu',
            'items' => json_decode('{"ace4e5d1-bd1e-4efc-b2bb-0480ebdc82a7":{"label":"Home","type":"page","data":{"url":"home","target":"_self","divider":true,"roles":null,"permissions":null,"id":null,"classes":null,"icon":null},"children":[]},"621ae4c6-0e44-4fff-8593-eed1de188518":{"label":"Search","type":"external-link","data":{"url":"\/search","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"90232819-8c73-43c8-a8b8-b0193197df72":{"label":"Blog","type":"external-link","data":{"url":"\/blog","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"6218d64b-301b-4745-8b56-77df4f0c3365":{"label":"Catalog","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":{"bc0b8667-6a8b-4f1f-b38c-8ffdd7f81641":{"label":"Property for rent","type":"external-link","data":{"url":"#","target":"","roles":[],"permissions":[],"id":null,"classes":null,"icon":null,"divider":false},"children":[]},"a3b4f761-bc00-449b-bd25-1edd572f6bf7":{"label":"Property for sale","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]}}},"507ca229-3734-4511-8096-48402f15e8ee":{"label":"Account","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":{"9d14760a-3c6f-4307-b290-e0f22e802779":{"label":"Personal Info","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"38d6c0f8-8936-420e-86bd-3ee3ed506799":{"label":"My properties","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"9e10fb2d-e79a-4e66-9375-c5a3b696c8ba":{"label":"Wishlist","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"2bd87fe4-c18c-430d-92ef-3b887d54324d":{"label":"Notifications","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":{"64243513-6bf3-4d07-bd29-1457121bdcdc":{"label":"Notifications for rent","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":{"821164da-4fd3-4e8a-a8e4-923e1b812fc8":{"label":"Properties in wishlist","type":null,"data":{"roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":{"18659853-fd21-448c-9229-93dad0baa0ff":{"label":"Properties yesterday","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]}}}}},"c00e325c-b1ae-4a70-aca7-5cf86cc46ff1":{"label":"Notifications for sales","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]}}}}}}'),
        ]);
        Navigation::create([
            'name' => 'Quick Links',
            'handle' => 'quick-links',
            'items' => json_decode('{"c14da641-743d-402c-914c-b833c3a64d52":{"label":"Buy a property","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"9152fc47-f70d-48f4-914c-b327ec04f77f":{"label":"Sell a property","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"69884a88-bb48-4d43-b783-2a4ee460aa93":{"label":"Rent a property","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"c72c3d1e-0c31-43fd-b9d7-18de7f24c657":{"label":"Calculate your property","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"ca9474f0-3bb3-4c11-afd7-f98f8a598b2b":{"label":"Top offers","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"1de76e7b-c8bf-4c38-8e87-f1ee468f0b2b":{"label":"Top cities","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]}}'),
        ]);
        Navigation::create([
            'name' => 'About',
            'handle' => 'about-links',
            'items' => json_decode('{"041abdf6-1620-4591-a2a8-0c141f1fbaa9":{"label":"About Us","type":"external-link","data":{"url":"#","target":"","roles":[],"permissions":[],"id":null,"classes":null,"icon":null,"divider":false},"children":[]},"8d8029ce-9cf0-4b7b-a889-f4dfd6687a03":{"label":"Our agents","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"84b4f4be-3965-4db2-a77e-fbbd3f549863":{"label":"Help & support","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"99dc0c6b-101e-4484-a8c5-4315fb367203":{"label":"Contacts","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]},"6a856b3c-e1c8-4f9f-875d-c6d92b79d7a7":{"label":"News","type":"external-link","data":{"url":"#","target":"","roles":null,"permissions":null,"id":null,"classes":null,"icon":null,"divider":null},"children":[]}}'),
        ]);
    }
}
