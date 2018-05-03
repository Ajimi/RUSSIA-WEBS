<?php
/**
 * Created by PhpStorm.
 * User: KaYdaz
 * Date: 30/04/2018
 * Time: 11:25
 */

namespace Player\PlayerBundle\Util;

use Player\PlayerBundle\Entity\Skill;

class SkillApiController
{
    /**
     * @param array|Skill[] $skills
     * @return array
     * @internal param $
     */
    public static function serializer($skills)
    {
        $data = array();
        foreach ($skills as $skill) {
            $skillData = SkillApiController::serialize($skill);
            $data[] = $skillData;
        }
        return $data;
    }

    /**
     * @param Skill $skill
     * @return array
     * @internal param $skills
     */
    public static function serialize(Skill $skill)
    {
        return array(
            "id" => $skill->getId(),
            "label" => $skill->getLabel(),
            "value" => $skill->getValue()
        );
    }
}