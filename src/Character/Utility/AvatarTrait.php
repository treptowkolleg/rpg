<?php

namespace Btinet\Rpg\Character\Utility;

use PhpTui\Tui\Extension\ImageMagick\Widget\ImageWidget;

trait AvatarTrait
{

    private ?ImageWidget $avatar = null;

    /**
     * @return ImageWidget|null
     */
    public function getAvatar(): ?ImageWidget
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        if(file_exists(asset_dir. $avatar)) {
            $this->avatar = new ImageWidget(path: asset_dir. $avatar);
        } else {
            echo "File not Found!";
        }
    }

}
