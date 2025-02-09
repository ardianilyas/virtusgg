<?php

namespace App\Enum;

enum  OrganizationMemberRoleEnum: string {
    case OWNER = 'owner';
    case PROJECT_MANAGER = 'project manager';
    case MEMBER = 'member';
}