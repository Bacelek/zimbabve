<?php

namespace controllers;

use models\photogragher\Photographer;

class PhotographerController extends MainController
{
    public function __construct()
    {
        parent::__construct(Photographer::class);
    }

    public function setModelProperties($item, $postData, $fileData = null): void
    {
        $item->setFirstName($postData['setPhotographerFirstName']);
        $item->setLastName($postData['setPhotographerLastName']);
        if (isset($fileData['setPhotographerImage'])) {
            $imageName = $fileData['setPhotographerImage']['name'];
            $imageTmpPath = $fileData['setPhotographerImage']['tmp_name'];
            $imageDestination = __DIR__ . '/../templates/images/' . basename($imageName);
            if (move_uploaded_file($imageTmpPath, $imageDestination)) {
                $item->setImage($imageName);
            } else {
                $item->addError("Ошибка загрузки изображения.");
            }
        }
    }

    public function getRequiredFields(): array
    {
        return ['setPhotographerFirstName', 'setPhotographerLastName', 'file:setPhotographerImage'];
    }
}
