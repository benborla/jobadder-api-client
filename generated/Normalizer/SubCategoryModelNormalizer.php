<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class SubCategoryModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\SubCategoryModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\SubCategoryModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\SubCategoryModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'subCategoryId')) {
            $object->setSubCategoryId($data->{'subCategoryId'});
        }
        if (property_exists($data, 'name')) {
            $object->setName($data->{'name'});
        }
        if (property_exists($data, 'skills')) {
            $values = [];
            foreach ($data->{'skills'} as $value) {
                $values[] = $this->serializer->deserialize($value, 'BenBorla\\JobAdder\\V2\\Model\\SkillCategoryModel', 'raw', $context);
            }
            $object->setSkills($values);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getSubCategoryId()) {
            $data->{'subCategoryId'} = $object->getSubCategoryId();
        }
        if (null !== $object->getName()) {
            $data->{'name'} = $object->getName();
        }
        if (null !== $object->getSkills()) {
            $values = [];
            foreach ($object->getSkills() as $value) {
                $values[] = $this->serializer->serialize($value, 'raw', $context);
            }
            $data->{'skills'} = $values;
        }

        return $data;
    }
}
