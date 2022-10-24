<?php

namespace App\Controller\Admin\Filter;

use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Filter\FilterInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FilterDataDto;
use EasyCorp\Bundle\EasyAdminBundle\Filter\FilterTrait;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\TextFilterType;

class AssociationFilter implements FilterInterface
{
    use FilterTrait;

    protected $alias;
    protected $joinClass;

    public static function new(string $propertyName, $label = null): self
    {
        $filter = (new self());
        $parts = explode('.', $propertyName);

        return $filter
            ->setFilterFqcn(__CLASS__)
            ->setAlias($parts[0])
            ->setProperty(str_replace('.','_',$propertyName))
            ->setLabel($label)
            ->setFormType(TextFilterType::class)
            ->setFormTypeOption('translation_domain', 'EasyAdminBundle');
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    public function apply(QueryBuilder $queryBuilder, FilterDataDto $filterDataDto, ?FieldDto $fieldDto, EntityDto $entityDto): void
    {
        $property = str_replace($this->alias.'_', '', $filterDataDto->getProperty());
        $comparison = $filterDataDto->getComparison();
        $parameterName = $filterDataDto->getParameterName();
        $countries = $filterDataDto->getValue();

        $em = $queryBuilder->getEntityManager();
        $meta = $em->getClassMetadata($entityDto->getFqcn());
        $mappingInfo = $meta->getAssociationMapping($this->alias);

        $queryBuilder
            ->innerJoin($mappingInfo['targetEntity'], $this->alias, Expr\Join::WITH, 'entity.'. $this->alias.' = '. $this->alias.'')
            ->andWhere(sprintf('%s.%s %s :%s', $this->alias, $property, $comparison, $parameterName))
            ->setParameter($parameterName, $countries);
    }
}