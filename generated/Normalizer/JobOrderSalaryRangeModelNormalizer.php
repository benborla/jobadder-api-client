<?php

namespace BenBorla\JobAdder\V2\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class JobOrderSalaryRangeModelNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BenBorla\\JobAdder\\V2\\Model\\JobOrderSalaryRangeModel') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BenBorla\JobAdder\V2\Model\JobOrderSalaryRangeModel) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BenBorla\JobAdder\V2\Model\JobOrderSalaryRangeModel();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'ratePer')) {
            $object->setRatePer($data->{'ratePer'});
        }
        if (property_exists($data, 'rateLow')) {
            $object->setRateLow($data->{'rateLow'});
        }
        if (property_exists($data, 'rateHigh')) {
            $object->setRateHigh($data->{'rateHigh'});
        }
        if (property_exists($data, 'currency')) {
            $object->setCurrency($data->{'currency'});
        }
        if (property_exists($data, 'timePerWeek')) {
            $object->setTimePerWeek($data->{'timePerWeek'});
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getRatePer()) {
            $data->{'ratePer'} = $object->getRatePer();
        }
        if (null !== $object->getRateLow()) {
            $data->{'rateLow'} = $object->getRateLow();
        }
        if (null !== $object->getRateHigh()) {
            $data->{'rateHigh'} = $object->getRateHigh();
        }
        if (null !== $object->getCurrency()) {
            $data->{'currency'} = $object->getCurrency();
        }
        if (null !== $object->getTimePerWeek()) {
            $data->{'timePerWeek'} = $object->getTimePerWeek();
        }

        return $data;
    }
}
