<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class SubmitIdealSalaryModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\SubmitIdealSalaryModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\SubmitIdealSalaryModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\SubmitIdealSalaryModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'workTypeId')) {
            $object->setWorkTypeId($data->{'workTypeId'});
        }
        if (property_exists($data, 'salary')) {
            $object->setSalary($this->serializer->deserialize($data->{'salary'}, 'BenBorla\\JobAdder\\V2\\Model\\SalaryRangeModel', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getWorkTypeId()) {
            $data->{'workTypeId'} = $object->getWorkTypeId();
        }
        if (null !== $object->getSalary()) {
            $data->{'salary'} = $this->serializer->serialize($object->getSalary(), 'raw', $context);
        }

        return $data;
    }
}
