<?php

namespace App\Enum;

enum  OrganizationMemberRoleEnum: string {
    case OWNER = 'owner';
    case MEMBER = 'member';
}